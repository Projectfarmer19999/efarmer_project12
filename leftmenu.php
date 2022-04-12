<div class="list styled custom-list">
    <div style="margin-left: 10px;margin-bottom: 10px;text-align: center;">
        <?php
        if (!empty($user_image)) {
            echo '<img src="' . $user_image . '" width= "250" style="border: solid 1px #ccc;"/>';
        } else {
            echo '<img src="images/default.jpg" width="250" style="border: solid 1px #ccc;"/>';
        }
        if (!empty($user_name)) {
            echo '<p style="text-align:left;padding-top:10px;"><strong>' . ucfirst($user_name) . '</strong></p>';
        }
        ?>
    </div>
    <ul>
        <li><a href="myaccount.php">My Account</a></li>
        <?php
        if ($user_type == "admin") {
            ?> 
            <li><a href="view_faq.php">Faq List</a></li>
            <li><a href="chatting.php">Chatting</a></li>
            <li><a href="mandi.php">Mandi</a></li>
            <li><a href="view_vendor.php">Vender List</a></li>
            <li><a href="view_farmer.php">Farmer List</a></li>            
            <li><a href="add_crops.php">Add Crops</a></li>
            <li><a href="crops_list.php">Crops List</a></li>            
            <li><a href="expert.php">Add Expert</a></li>
            <li><a href="expert_list.php">Expert List</a></li>
			<li><a href="add_weather.php">Add Weather</a></li>
            <li><a href="contact_list.php">Contact List</a></li>
            <?php
        } elseif ($user_type == "vender") {
            ?>            
            <li><a href="biding.php">Biding</a></li>
            <li><a href="bidlist.php">Biding List</a></li>
            <li><a href="crops_list.php">View Crops</a></li>
            <li><a href="view_farmer.php">View Farmer</a></li>
            <?php
        } elseif ($user_type == "expert") {
            ?>            
            <li><a href="view_vendor.php">View Vendor</a></li>
            <li><a href="view_farmer.php">View Farmer</a></li>            
            <li><a href="crops_list.php">View Crops</a></li>
            <li><a href="view_faq.php">Faq List</a></li>            
            <li><a href="chatting.php">Chatting</a></li>
            <?php
        } else {
            ?>
            <li><a href="faq.php">Faq</a></li>
			 <li><a href="weather_list.php">View Weather Report</a></li>
            <li><a href="chatting.php">Chatting</a></li>
        <?php } ?>
        <li><a href="changepassword.php">Change Password</a></li>
    </ul>
</div>