<?php

include '../dbconfigur.php';

$senderID = isset($_POST['senderid']) ? $_POST['senderid'] : '';
$senderName = isset($_POST['sendername']) ? $_POST['sendername'] : '';
$userMessage = isset($_POST['message']) ? $_POST['message'] : '';

if (!empty($senderID) && !empty($userMessage) && !empty($senderName)) {

    echo $sql_ins_chat = "INSERT INTO chatting(user_id,user_name,message,created,receiver_id) VALUES ('" . $user_id . "','" . $user_name . "','" . addslashes($userMessage) . "','" . date('Y-m-d H:i:s') . "','" . $senderID . "')";
    mysqli_query($conn, $sql_ins_chat);
    echo 'sucess';
    exit();
}