<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $uID = "";
    $uName = "";
    if (isset($_GET['user_id']) && isset($_GET['user_name'])) {
        $uID = mysqli_real_escape_string($conn, $_GET['user_id']);
        $uName = mysqli_real_escape_string($conn, $_GET['user_name']);
        //Update query chating status
        mysqli_query($conn, "UPDATE chatting SET read_status = '1' WHERE user_id = '$uID'");
    }
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <title>Chatting - E-Farmer</title>
            <?php include './title.php'; ?>
            <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen" />  
            <link rel="stylesheet" type="text/css" href="chatfiles/chatstyle.css" />
        </head>
        <script type="text/javascript">
            //Function to load user list
            $(document).ready(function() {

                $.ajaxSetup({cache: false});
                setInterval(function() {
                    $('#chatdiv').load('ajax/chat_message.php?user_id=<?php echo $uID; ?>');
                }, 3000);
               
                $("#btnsend").click(function(e) {
                    //e.preventDefault();                        
                    var senderid = '<?php echo $uID; ?>';
                    var sendername = '<?php echo $uName; ?>';
                    var message = $("#textmessage").val();
                    var dataString = 'senderid=' + senderid + '&message=' + message + '&sendername=' + sendername;
                    $.ajax({
                        type: 'POST',
                        data: dataString,
                        url: 'ajax/send_message.php',
                        success: function(data) {
                            $("#textmessage").val("");
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php include './header.php'; ?>
        <header id="head" class="secondary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h1>Chatting</h1>
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
                    <div class="form-light mt-20">                        
                        <form class="form-light mt-20" role="form" method="post" action="">
                            <table class="table_list">
                                <tr>
                                    <td width="500" valign="top" style="background: #ccc;font-size: 18px;font-weight: bold;padding:5px 5px 5px 10px;">                                       
                                            <?php
                                            if (!empty($uID) && !empty($uName)) {
                                                echo ucfirst($uName);
                                            } else {
                                                echo 'Live Chat';
                                            }
                                            ?>                                                                               
                                    </td>
                                    <td  valign="top" style="background: #ccc;font-size: 18px;font-weight: bold;padding:5px 5px 5px 10px;">
                                        Select Users
                                    </td>
                                    <tr>
                                        <td valign="top">
                                            <div  style="width: 500px;height: 550px;overflow-y: scroll;background: #fff;padding-left:5px;">
                                                <?php
                                                $sql_chat = "SELECT user_id,user_name,message,DATE_FORMAT(created,'%m-%d-%Y %h:%i %p') AS msg_date FROM chatting WHERE user_id = '" . $user_id . "'  OR receiver_id = '" . $user_id . "' ";
                                                $res_chat = mysqli_query($conn,$sql_chat);
                                                if (mysqli_num_rows($res_chat) > 0) {
                                                    while ($row_chat = mysqli_fetch_array($res_chat)) {
                                                        ?>
                                                        <p style="line-height: 18px;font-size: 12px;">
                                                            <span style="font-weight: bold;">
                                                                <?php echo ucfirst($row_chat['user_name']); ?>: </span>
                                                            <span><?php echo nl2br(stripslashes($row_chat['message'])) ?></span><br/>
                                                            <span style="color: darkgrey">
                                                                <?php echo $row_chat['msg_date']; ?></span>
                                                        </p>
                                                        <?php
                                                    }
                                                    ?>                                                
                                                    <?php
                                                } else {
                                                    echo '<p>Message not available.</p>';
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td rowspan="3" valign="top">
                                            <?php
                                            $sql_chat_user = "SELECT id,`name`,login_status FROM users WHERE `status` = '1' AND id NOT IN ('$user_id') ORDER BY `name` ASC";
                                            $res_chat_user = mysqli_query($conn,$sql_chat_user);
                                            while ($row_chat_user = mysqli_fetch_array($res_chat_user)) {
                                                if ($row_chat_user['login_status'] == 1) {
                                                    echo '<p class="select-all"><a style="color:darkgreen;" href="chatting.php?user_id=' . $row_chat_user['id'] . '&user_name=' . $row_chat_user['name'] . '" class="dashboard_link">' . $row_chat_user['name'] . '<span style="width:5px;height:px;background:green;"></span></a></p>';
                                                } else {
                                                    echo '<p class="select-all"><a href="chatting.php?user_id=' . $row_chat_user['id'] . '&user_name=' . $row_chat_user['name'] . '" class="dashboard_link">' . $row_chat_user['name'] . '</a></p>';
                                                }
                                                ?>
                                            <?php } ?>  
                                        </td>
                                    </tr>
                                    <?php
                                    if (!empty($uID) && !empty($uName)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" style="width: 500px;height: 80px;" name="textmessage" id="textmessage"></textarea>
                                            </td>                                           
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button" id="btnsend" name="btnsend" class="btn btn-one" style="margin-left:383px;"/>Send</button>                                                            
                                            </td>                                            
                                        </tr>    
                                    <?php } ?>
                            </table> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include './footer.php'; ?> 
    </body>
    </html>
    <?php
} else {
    $_SESSION['MSG'] = "You Must been login.";
    header("Location: login.php");
}
//mysql_close();
?>

