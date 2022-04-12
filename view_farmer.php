<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysqli_real_escape_string($_GET['id']);
        $sql = "DELETE FROM users WHERE id='" . $user_id . "'";
        $result = mysqli_query($conn, $sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:view_farmer.php?status=success");
        } else {
            $error = "Farmer has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>View Farmer - E-Farmer</title>
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
                            <h1>View Farmer</h1>
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
                                echo '<tr><td colspan="4">Farmer has been successfully deleted.</td></tr>';
                            }
                            if (!empty($error)) {
                                echo '<tr><td>' . $error . '</td></tr>';
                            }
                            ?>
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Name</td>
                                <td class="grid_heading">Email</td>
                                <td class="grid_heading">Phone</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM users where user_type='farmer'";
                            $res_contact = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res_contact) > 0) {
                                while ($row = mysqli_fetch_array($res_contact)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label">
                                            <a href="user_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['name'] ?></a>
                                        </td>
                                        <td class="grid_label"><?php echo $row['email'] ?></td>
                                        <td class="grid_label"><?php echo $row['phone_no'] ?></td>
                                        <td class="grid_label"><a href="view_farmer.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
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
