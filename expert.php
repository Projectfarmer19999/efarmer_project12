<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($name)) {
            $error = "Please enter mandi name";
        }
        if (empty($email)) {
            $error = "Please enter description";
        }
        if (empty($error)) {
            $path = "uploads/documents";
            $time = date("fYhis"); //get time  
            $com_file_path = "";

            $file_path = $_FILES['imgpath']['name'];
            if (!empty($file_path)) {
                $extension = substr(strrchr($file_path, '.'), 1);
                $extension = strtolower($extension);
                if ($extension == "png" || $extension == "jpg") {
                    $com_file_path = $path . "/" . $time . "." . $extension;
                    $action = copy($_FILES['imgpath']['tmp_name'], $com_file_path);
                } else {
                    $error = "Please upload png, jpg.";
                }
            }
            if (empty($error)) {
                echo $sql_query = "INSERT INTO users(name,email,phone_no,password,imgpath,adding_date,user_type)VALUES('" . $name . "','" . $email . "','" . $phone_no . "','" . $password . "','" . $com_file_path . "','" . date('Y-m-d h:i:s') . "','expert')";
                $result = $conn->query($sql_query);
                if ($result) {
                    header("location:expert.php?reg=success");
                } else {
                    $error = "Expert has not been saved.";
                }
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Expert - E-Farmer</title>
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
                            <h1>Add Crops</h1>
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
                        <form action="expert.php" method="post"  enctype="multipart/form-data">
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                    echo '<div class="style">Expert has been successfuly added.</div>';
                                }
                                ?> 
                            </div> 
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your name" maxlength="255">                               
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your email id" maxlength="255">                               
                            </div>
                            <div class="form-group">
                                <label>Phone No:</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Your phone no" maxlength="16">                               
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" id="password" class="form-control" maxlength="16">                               
                            </div>
                            <div class="form-group">
                                <label>Image:</label>
                                <input type="file" name="imgpath" id="imgpath" class="form-control">                               
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