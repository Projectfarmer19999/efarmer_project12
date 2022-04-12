<?php
include '../dbconfigur.php';
?>
<div class="box-head">
    <h2>Select Users</h2>
</div>
<div class="box-content">
    <?php
    $sql_chat_user = "SELECT user_id,user_name FROM chatting WHERE user_type != 0 GROUP BY user_id ORDER BY ID DESC";
    $res_chat_user = mysqli_query($conn, $sql_chat_user);
    while ($row_chat_user = mysqli_fetch_array($res_chat_user)) {
        echo '<p class="select-all"><a href="live-chat.php?user_id=' . $row_chat_user['user_id'] . '&user_name=' . $row_chat_user['user_name'] . '" class="dashboard_link">' . $row_chat_user['user_name'] . '</a></p>';
        ?>
    <?php } ?>                                        
</div>

