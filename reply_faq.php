<?php
include 'dbconfigur.php';
if (!empty($user_id)) {

    $faq_id = isset($_GET['id']) ? $_GET['id'] : '';
    $error = "";
    if (isset($_POST['btnupdate'])) {
        extract($_POST);
        $query = "update faqs set answer='$answer', answer_date='" . date('Y-m-d h:i:s') . "',replyby = '$user_id' where id = '$faq_id'";
        $r = $conn->query($query);
        $num = (int) $r;
        if ($num > 0) {
            $error = "Faq has been replyed successfully.";
        } else {
            $error = "Faw has not been replyed.";
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
                        <form action="" method="post" >
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if(!empty($error)){
                                    echo $error;
                                }
                                
                                ?>
                                <?php
                                $i = 0;
                                $sql = "SELECT * FROM faqs WHERE id = '" . $faq_id . "' ";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    ?>
                                </div> 
                                <div class="form-group">
                                    <img src="<?php echo $row['image'] ?>" height="300" />
                                </div>
                                <div class="form-group">
                                    <label><?php echo $row['faq'] ?></label>
                                    <textarea class="form-control" id="answer" name="answer" placeholder="Enter Faq Answer" style="height:100px;" ></textarea>
                                    <input type="hidden" value="<?php echo $faq_id ?>" name="faq_id"/>
                                </div>

                                <button type="submit" id="btnupdate" name="btnupdate" class="btn btn-two" onclick="return preparationFormValidation()" >Submit</button><p><br/></p>
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