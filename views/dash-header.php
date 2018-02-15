<header>
    <div class="nav-search <?php echo $user_logged;?>">
        <input type="checkbox" id="cbox-toggle-sidebar">
        <label for="cbox-toggle-sidebar"><i class="fa fa-bars"></i></label>

        <div class="search">
            <input type="text" id="txt-dash-search" title="txt-dash-search" placeholder="Search">
            <i class="fa fa-search"></i>
        </div>
    </div>

    <img src="../images/logo1.png" alt="Cupon Tours">

    <div class="nav-notifications <?php echo $user_logged;?>">
        <div class="profile">
            <i class="fa fa-user"></i>
            <span class="counter hidden">0</span>
        </div>
        <div class="notifications">
            <i class="fa fa-bell"></i>
            <span class="counter">3</span>
        </div>
        <div class="messages">
            <i class="fa fa-envelope"></i>
            <span class="counter">5</span>
        </div>
    </div>
</header>