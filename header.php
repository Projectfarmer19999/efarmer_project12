<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">            
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <h2 style="color: #000;margin-top: 0px;">E-Farmer</h2></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right mainNav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="bidinginformation.php">Biding Information</a></li>

                <?php
                if (!empty($user_id)) {
                    ?>
                    <li><a href="myaccount.php">My Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>       
    </div>
</div>