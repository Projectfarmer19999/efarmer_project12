<?php
include 'dbconfigur.php';
error_reporting(0);
if (!empty($user_id)) {

    $error = "";
    if (isset($_POST['btnupdate'])) {
        extract($_POST);

        $path = "uploads/documents";
        $time = date("fYhis"); //get time
        $comImagePath = "";
        $profile_image = $_FILES['fileimg']['name'];
        if (!empty($profile_image)) {
            $extension = substr(strrchr($profile_image, '.'), 1); //filethumgimg
            $comImagePath = $path . "/" . $time . "." . $extension;
            $action = copy($_FILES['fileimg']['tmp_name'], $comImagePath);
            //update profile pic
            $conn->query("update users set imgpath='" . $comImagePath . "' where id = '$user_id'");
        }
        if (!empty($comImagePath)) {
            $_SESSION['map_user_image'] = $comImagePath;
        }

        $query = "update users set dob='" . $dob . "', city='$city', state='$state', address='$address', country='$country', pin_no='$pin_no',gender = '$gender' where id = '$user_id' ";
        $r = $conn->query($query);
        $num = (int) $r;
        if ($num > 0) {
            $error = "Your profile has been successfully updated.!!";
        } else {
            $error = "Your profile has not been updated.!!";
        }
    }
    ?>
    <html>
        <head>
            <title>My Account - E-Farmer</title>
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
                            $sql = "SELECT * FROM users WHERE id = '" . $user_id . "' ";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_array($result);
                                ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $row['phone_no']; ?>">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option> - - - - - Select - - - - - </option>
                                            <?php
                                            if (strtolower($row['gender']) == "male") {
                                                echo '<option value="Male" selected>Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            } else if (strtolower($row['gender']) == "female") {
                                                echo '<option value="Male">Male</option>';
                                                echo '<option value="Female" selected>Female</option>';
                                            } else {
                                                echo '<option value="Male">Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            }
                                            ?>
                                        </select> 
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
                                            <input type="text" id="city" name="city" class="form-control" value="<?php echo $row['city']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state" name="state" class="form-control" value="<?php echo $row['state']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address" style="height:100px;"><?php echo $row['address']; ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" name="country" class="form-control"value="<?php echo $row['country']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="text" id="pin_no" name="pin_no" class="form-control" value="<?php echo $row['pin_no']; ?>">
                                        </div>
                                    </div>
                                </div>                                 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" id="fileimg" name="fileimg">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                ?>
                                <button type="submit" id="btnupdate" name="btnupdate" class="btn btn-one" onclick="return myaccountFormValidation()"/>Update</button><p><br/></p>
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
?>