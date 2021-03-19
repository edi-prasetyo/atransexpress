<?php
//Proteksi Halaman Main Agen
if ($this->session->userdata('role_id') == 7) {
    is_login();
    //Gabungan Semua layout
    require_once('header.php');
    require_once('topbar.php');
    require_once('sidebar.php');
    require_once('content.php');
    require_once('footer.php');
} else {
    redirect('home');
}
