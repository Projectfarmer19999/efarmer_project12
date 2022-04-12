<?php
include 'dbconfigur.php';
error_reporting(E_ALL);
if (!empty($user_id)) {

    $uid = isset($_GET['id']) ? $_GET['id'] : '';
    ?>
    <html>
        <head>
            <title>User Details - E-Farmer</title>
            <?php include 'title.php'; ?>
            <script type="text/javascript" src="js/scw.js"></script>
        </head>
        <body>
            <?php
            include 'header.php';
            ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1>My Account</h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include 'leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <form class="form-light mt-20" role="form" method="post" action="myaccount.php" enctype="multipart/form-data">
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM users WHERE id = '" . $uid . "' ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_array($result);
                                ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>" readonly="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $row['phone_no']; ?>" readonly="">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                        <input type="text" id="gender" name="gender" class="form-control"value="<?php echo $row['gender']; ?>" readonly="">                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" id="dob" name="dob" class="form-control" value="<?php echo $row['dob']; ?>" readonly="" onclick="scwShow(this, event)"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="city" name="city" class="form-control" value="<?php echo $row['city']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state" name="state" class="form-control" value="<?php echo $row['state']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address" style="height:100px;" readonly=""><?php echo $row['address']; ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" name="country" class="form-control"value="<?php echo $row['country']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="text" id="pin_no" name="pin_no" class="form-control" value="<?php echo $row['pin_no']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>  
                            <?php } ?>
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
mysql_close();
?>