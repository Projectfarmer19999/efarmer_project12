<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $bidid = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM bids WHERE id='" . $bidid . "' and user_id = '" . $user_id . "'";
        $result = $conn->query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:bidlist.php?status=success");
        } else {
            $error = "Bid  has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Bid List - E-Farmer </title>
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
                            <h1>Bid List</h1>
                        </div>
                    </div>
                </div>
            </header>            
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include './leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div>                         
                        <table class="table_list">
                            <?php
                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<tr><td colspan="4">Bid has been successfully deleted.</td></tr>';
                            }
                            if (!empty($error)) {
                                echo '<tr><td>' . $error . '</td></tr>';
                            }
                            ?>
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Mandi</td>
                                <td class="grid_heading">Crop</td>
                                <td class="grid_heading">Price</td>
                                <td class="grid_heading">Duration</td>
                                <td class="grid_heading">Date</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT m.name as mandi_name,c.name as crop_name, b.* from bids b join mandies m on m.id = b.mandi_id join crops c on c.id = b.crop_id where b.user_id = '" . $user_id . "'";
                            $res_contact = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res_contact) > 0) {
                                while ($row = mysqli_fetch_array($res_contact)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['mandi_name'] ?></td>
                                        <td class="grid_label"><?php echo $row['crop_name'] ?></td>
                                        <td class="grid_label"><?php echo $row['price'] ?></td>
                                        <td class="grid_label"><?php echo $row['duration'] ?> Days</td>
                                        <td class="grid_label"><?php echo $row['created'] ?></td>
                                        <td class="grid_label"><a href="bidlist.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>

                        </div>                
                    </div>
                </div>       
                <?php
                include 'footer.php';
                ?>               
            </body>
        </html>
        <?php
    } else {
        header("location:login.php?msg=login");
        ob_flush();
    }
}
?>
