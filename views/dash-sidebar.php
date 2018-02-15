<section class="sidebar">
    <div class="sidebar-container">
        <div class="profile-info">
            <div class="profile-pic">
                <img src="" alt="">
            </div>
            <div class="profile-welcome">
                <p><i><b>Welcome</b> to Cupon Tours</i></p>
                <p class="username"><i><b><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></b></i> <span class="logout">Logout</span></p>
                <p><i class="fa fa-map-marker"></i><i>  Florida, USA</i></p>
            </div>
        </div>

        <?php
        $_url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $_dash_main = "";
        $_dash_map = "";
        $_dash_guide = "";
        $_dash_training = "";
        $_dash_calendar = "user";
        $_dash_alerts = "";
        $_dash_esignature = "";
        $_dash_voip = "";
        $_dash_leads = "";
        $_dash_payments = "";
        $_dash_subscriptions = "";
        $_dash_store = "";
        $_dash_reservations = "";

        if(strpos($_url,"/views/dash-member.php")){
            $_dash_main = "active";
        }
        if(strpos($_url,"/views/dash-map.php")){
            $_dash_map = "active";
        }
        if(strpos($_url,"/views/dash-guide.php")){
            $_dash_guide = "active";
        }
        if(strpos($_url,"/views/dash-training.php")){
            $_dash_training = "active";
        }
        if(strpos($_url,"/views/dash-calendar.php")){
            $_dash_calendar = "active";
        }
        if(strpos($_url,"/views/dash-alerts.php")){
            $_dash_alerts = "active";
        }
        if(strpos($_url,"/views/dash-esignature.php")){
            $_dash_esignature = "active";
        }
        if(strpos($_url,"/views/dash-voip.php")){
            $_dash_voip = "active";
        }
        if(strpos($_url,"/views/dash-leads.php")){
            $_dash_leads = "active";
        }
        if(strpos($_url,"/views/dash-payments.php")){
            $_dash_payments = "active";
        }
        if(strpos($_url,"/views/dash-subscriptions.php")){
            $_dash_subscriptions = "active";
        }
        if(strpos($_url,"/views/dash-store.php")){
            $_dash_store = "active";
        }
        if(strpos($_url,"/views/dash-reservations.php")){
            $_dash_reservations = "active";
        }

        ?>
        <ul>
            <li class="<?php echo $_dash_main;?>"><i class="left fa fa-tachometer"></i><span>Dashboard</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_map;?>"><i class="left fa fa-map-marker"></i><span>Locations Map</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_guide;?>"><i class="left fa fa-file"></i><span>Working Guide</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_training;?>"><i class="left fa fa-book"></i><span>Training</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_calendar;?>"><i class="left fa fa-calendar"></i><span>Calendar</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_alerts;?>"><i class="left fa fa-bell"></i><span>Alerts</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_esignature;?>"><i class="left fa fa-pencil"></i><span>E-Signature</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_voip;?>"><i class="left fa fa-phone"></i><span>Telephone VoIP</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_leads;?>"><i class="left fa fa-money"></i><span>Buying Leads</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_payments;?>"><i class="left fa fa-credit-card"></i><span>Payments</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_subscriptions;?>"><i class="left fa fa-user-plus"></i><span>Subscriptions</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_store;?>"><i class="left fa fa-cart-plus"></i><span>Selling Ítems</span><i class="right fa fa-chevron-right"></i></li>
            <li class="<?php echo $_dash_reservations;?>"><i class="left fa fa-list-alt"></i><span>Reservations</span><i class="right fa fa-chevron-right"></i></li>
        </ul>

        <div class="sidebar-footer">
            <p>&copy; 2016 <b>CUPONTOURS.COM</b></p>
            <p><i>All Rights Reserved</i></p>
        </div>
    </div>
</section>