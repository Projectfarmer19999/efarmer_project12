<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $cropid = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM weather WHERE id='" . $cropid . "'";
        $result = $conn->query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:weather_list.php?status=success");
        } else {
            $error = "Weather has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Weather List - E-Farmer </title>
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
                            <h1>Weather List</h1>
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
                                echo '<tr><td colspan="4">Weather has been successfully deleted.</td></tr>';
                            }
                            if (!empty($error)) {
                                echo '<tr><td>' . $error . '</td></tr>';
                            }
                            ?>
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Temperature</td>
                                <td class="grid_heading">Weather Image</td>
                                <td class="grid_heading">Humidity</td>
                                <td class="grid_heading">Description with Location</td>
                                <td class="grid_heading">Visibility(K.M.)</td>
								 <td class="grid_heading">Date</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM weather order by id ASC";
                            $res_contact = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res_contact) > 0) {
                                while ($row = mysqli_fetch_array($res_contact)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['name'] ?></td>
                                        <td class="grid_label"><img src="<?php echo $row['imgpath'] ?>"height="80"></td>
                                        <td class="grid_label"><?php echo $row['price'] ?></td>
										<td class="grid_label"><?php echo $row['description'] ?></td>
                                        <td class="grid_label"><?php echo $row['quantity'] ?></td>
										 <td class="grid_label"><?php echo $row['add_date'] ?></td>
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
