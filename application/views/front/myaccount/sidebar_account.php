<!-- Start Navigation -->
<div class="card">
<nav id='nav'>
    <div class='container'>
        <label class='show-menu' for='show-menu'><b><i class='fas fa-ellipsis-h'></i></b>
            <span>Show Menu</span></label>
        <input autocomplete='off' id='show-menu' role='button' type='checkbox' />
        <ul id='menus'>
            <li><a href="<?php echo base_url('myaccount'); ?>"><i class="ti-user"></i> My Account</a></li>
            <li><a href="<?php echo base_url('myaccount/ubah_password'); ?>"><i class='ti-lock'></i> Ubah Password</a></li>
            <li><a href="<?php echo base_url('auth/logout'); ?>"><i class='ti-share'></i> Logout</a></li>
        </ul>
    </div>
</nav>
</div>
<!--end navigation-->