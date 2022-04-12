<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($name)) {
            $error = "Please enter Temperature";
        }
        if (empty($price)) {
            $error = "Please enter description with Location";
        }
        if (empty($error)) {
            $path = "uploads/crops";
            $time = date("fYhis"); //get time  
            $com_file_path = "";

            $file_path = $_FILES['imgpath']['name'];
            if (!empty($file_path)) {
                $extension = substr(strrchr($file_path, '.'), 1);
                $extension = strtolower($extension);
                if ($extension == "png" || $extension == "jpg" || $extension == "pdf") {
                    $com_file_path = $path . "/" . $time . "." . $extension;
                    $action = copy($_FILES['imgpath']['tmp_name'], $com_file_path);
                } else {
                    $error = "Please upload png, jpg, pdf,file.";
                }
            }
            if (empty($error)) {
             echo   $sql_query = "INSERT INTO weather(name,imgpath,price,description,quantity,add_date)VALUES('" . $name . "','" . $com_file_path . "','" . $price . "','" . $description . "','" . $quantity . "','" . date('Y-m-d h:i:s') . "')";
                $result = $conn->query($sql_query);
                if ($result) {
                    header("location:add_weather.php?reg=success");
                } else {
                    $error = "Weather Info has not been saved.";
                }
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Weather - E-Farmer</title>
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
                            <h1>Add Weather</h1>
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
                        <form action="add_weather.php" method="post"  enctype="multipart/form-data">
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                    echo '<div class="style">Weather has been successfuly added.</div>';
                                }
                                ?> 
                            </div> 
                            <div class="form-group">
                                <label>Temperature:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Current Temperature" maxlength="255">                               
                            </div>
                            <div class="form-group">
                                <label>Weather Image:</label>
                                <input type="file" name="imgpath" id="imgpath" class="form-control">                               
                            </div>  
                            <div class="form-group">
                                <label>Humidity:</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Current Humidity" maxlength="255">                               
                            </div>  
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Your Description with Location" style="height:100px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Visibility(K.M.):</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Current Visibility(K.M.)" maxlength="255">                               
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