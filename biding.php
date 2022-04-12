<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);

        //get crop price for checking        
        $sql_price = "SELECT price FROM `crops` WHERE id = '" . $crops . "'";
        $res_price = mysqli_query($conn, $sql_price);
        if (mysqli_num_rows($res_price) > 0) {
            $row = mysqli_fetch_array($res_price);

            if ($price >= $row['price']) {

                echo $sql_query = "INSERT INTO bids(user_id,crop_id,mandi_id,price,duration,created)VALUES('" . $user_id . "','" . $crops . "', '" . $mandi . "','" . $price . "','" . $duration . "','" . date('Y-m-d h:i:s') . "')";
                $result = $conn->query($sql_query);
                if ($result) {
                    header("location:biding.php?reg=success");
                } else {
                    $error = "Bid has not been saved.";
                }
            } else {
                $error = "Bid price should be gratte or equal to crop price.";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Bid  - E-Farmer</title>
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
                            <h1>Bid</h1>
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
                        <form action="biding.php" method="post" >
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                    echo '<div class="style">Bid has been successfuly added.</div>';
                                }
                                ?> 
                            </div> 
                            <div class="form-group">
                                <label>Mandi Name:</label>
                                <select name="mandi" id="mandi" class="form-control"  required=""> 
                                    <option> - - - - Select - - - - </option>
                                    <?php
                                    $sql = "SELECT * FROM mandies ORDER BY id ASC";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>                              
                            </div>                       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Crops</label>
                                        <select name="crops" id="crops" class="form-control"  required=""> 
                                            <option> - - - - Select - - - - </option>
                                            <?php
                                            $sql = "SELECT id,name FROM `crops` WHERE status = '1' order by name ASC";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                </div>                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration</label>
                                        <select name="duration" id="duration" class="form-control"  required=""> 
                                            <option> - - - - Select - - - - </option>
                                            <option value="1">1 Day</option>
                                            <option value="7">7 Day</option>
                                            <option value="10">10 Day</option>
                                            <option value="15">15 Day</option>
                                            <option value="30">30 Day</option>
                                            <option value="45">45 Day</option>                                            
                                        </select> 
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter your crops price" maxlength="20" required="">
                                    </div> 
                                </div>
                            </div>
                            <button type="submit" name="btnsubmit" class="btn btn-two" onclick="return preparationFormValidation()" >Submit</button><p><br/></p>
                        </form>
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
?>