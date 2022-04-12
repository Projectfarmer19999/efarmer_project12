<?php
include './dbconfigur.php';
?>
<html>
    <head>
        <title>Welcome to E-Farmer</title>
        <?php include 'title.php'; ?>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <!-- Header -->
        <header id="head">
            <div class="container">
                <div class="banner-content">
                    <div id="da-slider" class="da-slider">
                        <div class="da-slide">
                            <h2> Thomas Jefferson</h2>
                            <p>Agriculture is our wisest pursuit, because it will in the end contribute most to real wealth, good morals, and happiness</p>
                            <div class="da-img"></div>
                        </div>
                        <div class="da-slide">
                            <h2>Willie Nelson</h2>
                            <p>As long as there’s a few farmers out there, we’ll keep fighting for them</p>
                            <div class="da-img"></div>
                        </div>
                        <div class="da-slide">
                            <h2>Joel Salatin</h2>
                            <p>Frankly, any city person who doesn’t think I deserve a white-collar salary as a farmer doesn’t deserve my special food</p>
                            <div class="da-img"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->

        <section class="container">
            <div class="heading">
                <!-- Heading -->
                <h1>Why is farming important?</h1>
<h3> Without farmers, we wouldn’t have access to food and other basic necessities</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="images/farmingwomen_hero.jpg" alt="" class="img-responsive">
                </div>
                <div class="col-md-8">
                    <p>Agriculture  Community  consists  of  individuals who  pledge  support to a farm operation so that thefarmland  becomes, either  legally or  spiritually,  the  community's  farm,  with  the  growers  and  consumers providing mutual  support and sharing the risks and benefits of food production. Members also share in the risks of farming, including poor harvests due to unfavorable weather or pests. By direct sales to communit y members, who have provided the farmer with working capital in advance, growers receive better prices for their crops, gain some financial security, and are relieved of much of the burden of marketing</p>
                                        
                </div>
            </div>
        </section>



        <?php include './footer.php'; ?> 
    </body>
</html>
