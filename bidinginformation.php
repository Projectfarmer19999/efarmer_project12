<?php
include './dbconfigur.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Biding Information - E-Farmer</title>
        <?php include 'title.php'; ?>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <header id="head" class="secondary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h1>Biding Information</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- container -->
        <section class="container">
            <div class="row">
                <!-- main content -->
                <br/>
                <section class="col-sm-8 maincontent" style="min-height:500px;">
                    <div class="row">
                        <?php
                        $sql = "SELECT m.name as mandi_name,c.name as crop_name,c.imgpath,c.price as base_price,u.name as vendor_name,phone_no,u.id as vender_id, b.* from bids b join mandies m on m.id = b.mandi_id join crops c on c.id = b.crop_id join users u on u.id = b.user_id order by b.id desc";
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                        <div class="col-md-4" style="border: solid 1px #ccc;margin: 5px;">
                            <h4 class="text-center">Crop - <?php echo $row['crop_name']; ?></h4>
                                    <img src="<?php echo $row['imgpath'] ?>" class="img-responsive"/>                                    
                                    <p>
                                        Mandi - <?php echo $row['mandi_name']; ?><br/>
                                        Vender - <?php echo $row['vendor_name']; ?><br/>
										Mobile No. - <?php echo $row['phone_no']; ?><br/>
                                        Base Price - <?php echo $row['base_price']; ?><br/>
                                        Bid Price - <?php echo $row['price']; ?><br/>
                                        Duration - <?php echo $row['duration']; ?><br/>
                                        From - <?php echo $row['created']; ?><br/>
                                    </p>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<h4>Data not found.<h4>';
                        }
                        ?>


                    </div>
                </section>
            </div>
        </section>
        <?php
        include 'footer.php';
        ?>        
    </body>
</html>
