<?php
//index.php
session_start();
include_once 'app/controller/admincontroller.php';
include_once 'app/controller/kategoricontroller.php';
include_once 'app/controller/catatancontroller.php';
//routing sederhana
$action = isset($_GET['act']) ? $_GET['act'] : 'login';
$controller = new admincontroller();
//routing sederhana
$action = isset($_GET['act']) ? $_GET['act'] : 'login';
$admincontroller = new admincontroller();
$catatancontroller = new catatancontroller();
$kategoricontroller = new kategoricontroller();


switch($action){
    case'register':
        $controller->viewregister();
        break;
    case'register-process':
        $controller->register();
        break;
    case'login':
      $controller->index();
        break;
     case'login-process':
      $controller->login();
        break;
    case 'dashboard':
        $controller->dashboard();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
    $controller->index();
    break;
    case'kategori':
        $kategoricontroller->index();
        break;
    case'kategori-tambah':
        $kategoricontroller->tambah();
        break;
    case'kategori-tambah-proses':
        $kategoricontroller->tambahproses();
        break;
    case'kategori-edit':
        $kategoricontroller->edit();
        break;
    case'kategori-edit-proses':
        $kategoricontroller->editproses();
        break;
    case'kategori-hapus':
        $kategoricontroller->hapus();
        break;
    case'catatan':
        $catatancontroller->index();
        break;
    case 'catatan-tambah':
        $catatancontroller->tambah();
        break;
    case 'catatan-tambah-proses':
        $catatancontroller->tambahproses();
        break;
    case 'catatan-edit':
        $catatancontroller->edit();
        break;
    case 'catatan-edit-proses':
        $catatancontroller->editproses();
        break;
    case 'catatan-hapus':
        $catatancontroller->hapus();
        break;
}
?>