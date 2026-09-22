<?php

Include_once 'config/database.php';

include_once 'app/models/catatanmodel.php';

include_once 'app/models/kategorimodel.php';

class catatancontroller {
    private $db;
    private $catatanmodel;
    private $kategorimodel;

    public function __construct() {

        $database = new Database();
        $this->db = $database->getConnection();
        $this->catatanmodel = new catatanmodel($this->db);
        $this->kategorimodel = new kategorimodel($this->db);
    }
    public function index() {

        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php"); exit;
        }

        $data_catatan = $this->catatanmodel->getAll();

        include 'app/views/catatan/index.php';
    }

    public function tambah(){
        if (!isset($_SESSION['admin_id'])){
            header("Location: index.php"); exit;
        }
        $data_kategori = $this->kategorimodel->getAll();
        include 'app/views/catatan/tambah.php';
    }

    public function tambahproses(){
        if(!isset($_SESSION['admin_id'])){
        header("Location: index.php");
        exit;
        }
        if ($_POST){
            $judul = $_POST ['judul'];
            $isi = $_POST ['isi'];
            $kategori_id = $_POST ['kategori_id'];
            $admin_id = $_SESSION ['admin_id'];

            if(!empty($judul)){
                $this->catatanmodel->create($judul, $isi, $kategori_id, $admin_id);
                $_SESSION['success_msg'] = "Berhasil tambah catatan";
            }
        }
        header("Location: index.php?act=catatan");
        exit;
    }
 

    public function edit(){
    if (!isset($_SESSION['admin_id'])){
        header("Location: index.php"); 
        exit;
    }

    $id = isset($_GET['id']) ? $_GET['id'] : die('error: ID kosong');

    $catatan = $this->catatanmodel->getById($id);
    $data_kategori = $this->kategorimodel->getAll();

    include 'app/views/catatan/edit.php';
}

    public function editproses(){
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        if ($_POST){
            $id = $_POST['id'];
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $kategori_id = $_POST['kategori_id'];

            if(!empty($judul) && !empty($id)){
                $this->catatanmodel->update($id, $judul, $isi, $kategori_id);
                $_SESSION['succes_msg'] = "Berhasil edit catatan";
            }
        }

        header("Location: index.php?act=catatan");
    }

    public function hapus(){
        if (!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }

        if (isset($_GET['id'])){
            $this->catatanmodel->delete($_GET['id']);
            $_SESSION['success_msg'] = "Berhasil menghapus catatan";
          
        }

        header("Location: index.php?act=catatan");
        exit;
    }
}
?>