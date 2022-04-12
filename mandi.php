<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($name)) {
            $error = "Please enter mandi name";
        }
        if (empty($address)) {
            $error = "Please enter address";
        }

        if (empty($error)) {
            $sql_query = "INSERT INTO mandies(name, address,adding_date)VALUES('" . $name . "', '" . $address . "','" . date('Y-m-d h:i:s') . "')";
            $result = $conn->query($sql_query);
            if ($result) {
                header("location:mandi.php?reg=success");
            } else {
                $error = "Mandi has not been saved.";
            }
        }
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $userid = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "DELETE FROM mandies WHERE id='" . $userid . "'";
        $result = $conn->query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:mandi.php?status=success");
        } else {
            $error = "Mandi has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Mandi  - E-Farmer</title>
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
                            <h1>Mandi</h1>
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
                        <form action="mandi.php" method="post"  enctype="multipart/form-data">
                            <div colspan="2" valign="middle" align="center">
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                    echo '<div class="style">Mandi Address has been successfuly added.</div>';
                                }
                                ?> 
                            </div> 
                            <div class="form-group">
                                <label>Mandi Name:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your mandi name" maxlength="255">                               
                            </div>                       
                            <div class="form-group">
                                <label>Address:</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Your Address" style="height:100px;
                                          " ></textarea>
                            </div>
                            <button type="submit" name="btnsubmit" class="btn btn-two" onclick="return preparationFormValidation()" >Submit</button><p><br/></p>
                            <table class="table_list">
                                <?php
                                if (isset($_GET['status']) && $_GET['status'] == "success") {
                                    echo '<tr><td colspan="4">Mandi has been successfully deleted.</td></tr>';
                                }
                                if (!empty($error)) {
                                    echo '<tr><td>' . $error . '</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Mandi Name</td>
                                    <td class="grid_heading">Address</td>
                                    <td class="grid_heading">Delete</td>
                                </tr>
                                <?php
                                $i = 0;
                                $sql_mandi = "SELECT * FROM mandies ORDER BY name ASC";
                                $res_mandi = mysqli_query($conn, $sql_mandi);
                                if (mysqli_num_rows($res_mandi) > 0) {
                                    while ($row = mysqli_fetch_array($res_mandi)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label"><?php echo $row['name'] ?></td>                                            
                                            <td class="grid_label"><?php echo $row['address'] ?></td>
                                            <td class="grid_label"><a href="mandi.php?id=<?php echo $row ['id']; ?>">Delete</a></td>
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