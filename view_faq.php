<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $userid = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM faqs WHERE id='" . $userid . "'";
        $result = $conn->query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:view_faq.php?status=success");
        } else {
            $error = "Faq has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>View Faq - E-Farmer</title>
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
                            <h1>View Faq</h1>
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
                                    echo '<tr><td colspan="4">Faq has been successfully deleted.</td></tr>';
                                }
                                if (!empty($error)) {
                                    echo '<tr><td>' . $error . '</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Image</td>
                                    <td class="grid_heading">Name</td>
                                    <td class="grid_heading">Question</td>
                                    <td class="grid_heading">Date</td>
                                    <td class="grid_heading">Reply</td>
                                    <td class="grid_heading">Delete</td>
                                </tr>
                                <?php
                                $i = 0;
                                $sql_faq = "SELECT f.*,u.name FROM faqs f join users u where f.user_id = u.id ORDER BY id DESC";
                                $res_faq = mysqli_query($conn, $sql_faq);
                                if (mysqli_num_rows($res_faq) > 0) {
                                    while ($row = mysqli_fetch_array($res_faq)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label">
                                                <img src="<?php echo $row['image'] ?>" height="80">
                                            </td>
                                            <td class="grid_label"><?php echo $row['name'] ?></td>                                            
                                            <td class="grid_label"><?php echo $row['faq'] ?></td>
                                            <td class="grid_label"><?php echo $row['question_date'] ?></td>
                                            <td class="grid_label">
                                                <?php
                                                if(!empty($row['answer'])){
                                                    echo $row['answer'];
                                                }else{
                                                ?>
                                                <a href="reply_faq.php?id=<?php echo $row ['id']; ?>">Reply</a>
                                                <?php } ?>
                                            </td>
                                            <td class="grid_label"><a href="view_faq.php?id=<?php echo $row ['id']; ?>">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="7">Data not found.</td></tr>';
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
?>