<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $faqid = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM faqs WHERE id='" . $faqid . "'";
        $result = $conn->query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:faq.php?status=success");
        } else {
            $error = "Faq has not been deleted.";
        }
    }
    
    
    error_reporting(E_ALL);
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($faq)) {
            $error = "Please enter faq";
        }
        if (empty($error)) {

            $path = "uploads/faq";
            $time = date("fYhis"); //get time  
            $com_file_path = "";

            $file_path = $_FILES['image']['name'];
            if (!empty($file_path)) {
                $extension = substr(strrchr($file_path, '.'), 1);
                $extension = strtolower($extension);
                if ($extension == "png" || $extension == "jpg") {
                    $com_file_path = $path . "/" . $time . "." . $extension;
                    $action = copy($_FILES['image']['tmp_name'], $com_file_path);
                } else {
                    $error = "Please upload png and jpeg.";
                }
            }

            if (empty($error)) {
                $sql_query = "INSERT INTO faqs(user_id,faq,image,question_date,adding_date)"
                        . "VALUES('" . $user_id . "','" . $faq . "', '" . $com_file_path . "','" . date('Y-m-d h:i:s') . "','" . date('Y-m-d h:i:s') . "')";
                $result = $conn->query($sql_query);
                if ($result) {
                   header("location:faq.php?reg=success");
                } else {
                    $error = "Data has not been saved.";
                }
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Reply on Faq - E-Farmer</title>
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
                            <h1>Reply on faq</h1>
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
                        <form action="faq.php" method="post"  enctype="multipart/form-data">
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                    echo '<div class="style">Faq has been successfuly added.</div>';
                                }
                                ?> 
                            </div> 
                            <div class="form-group">
                                <label>Ask a Faq:</label>
                                <textarea class="form-control" id="faq" name="faq" placeholder="Your faq" style="height:100px;
                                          " ></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Paper:</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <button type="submit" name="btnsubmit" class="btn btn-two" onclick="return preparationFormValidation()" >Submit</button>
                            <p><br/></p>
                            <p><br/></p><p><br/></p>
                            
                            
                            <table class="table_list">
                                <?php
                                if (isset($_GET['status']) && $_GET['status'] == "success") {
                                    echo '<tr><td colspan="4">Faq has been successfully deleted.</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Faq</td>
                                    <td class="grid_heading">Reply</td>
                                    <td class="grid_heading">Date</td>
                                    <td class="grid_heading">Delete</td>
                                </tr>
                                <?php
                                $i = 0;
                                $sql_faq = "SELECT * FROM faqs WHERE user_id = '" . $user_id . "' order by id desc";
                                $res_faq = mysqli_query($conn, $sql_faq);
                                if (mysqli_num_rows($res_faq) > 0) {
                                    while ($row = mysqli_fetch_array($res_faq)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label"><?php echo $row['faq'] ?></td>
                                            <td class="grid_label"><?php echo $row['answer'] ?></td>                                            
                                            <td class="grid_label"><?php echo $row['question_date'] ?></td>
                                            <td class="grid_label"><a href="faq.php?id=<?php echo $row ['id']; ?>">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="7">Data not found.</td></tr>';
                                }
                                ?>
                            </table>

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