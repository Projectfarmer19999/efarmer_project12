<?php
include '../dbconfigur.php';
$uid = $_GET['user_id'];
mysqli_query($conn,"UPDATE chatting SET read_status = '1' WHERE user_id = '$uid'");
$sql_chat = "SELECT user_id,user_name,message,DATE_FORMAT(created,'%m-%d-%Y %h:%i %p') AS msg_date FROM chatting WHERE user_id = '" . $uid . "' OR receiver_id = '" . $uid . "' ";
$res_chat = mysqli_query($conn, $sql_chat);
if (mysqli_num_rows($res_chat) > 0) {
    while ($row_chat = mysql_fetch_array($res_chat)) {
        ?>
        <p style="line-height: 18px;font-size: 12px;">
            <span style="font-weight: bold;"><?php echo ucfirst($row_chat['user_name']); ?>: </span>
            <span><?php echo nl2br(stripslashes($row_chat['message'])) ?></span><br/>
            <span style="color: darkgrey">Sent at <?php echo $row_chat['msg_date']; ?></span>
        </p>
        <?php
    }
    ?>                                                
    <?php
} else {
    echo '<p>Message not available.</p>';
}
?>
