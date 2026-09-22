<?php
include_once 'config/database.php';
include_once 'app/models/kategorimodel.php';

class kategoricontroller{
    private $db;
    private $kategorimodel;
    
    public function __construct(){
        $datebase = new Database();
        $this->db = $datebase->getConnection();
        $this->kategorimodel = new kategorimodel($this->db);
    }
    public function index(){
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        $data_kategori = $this->kategorimodel->getAll();
        include 'app/views/kategori/index.php';
    }

    public function tambah()
    {
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");
             
            exit;
        }
        include 'app/views/kategori/tambah.php';
    }

    public function tambahproses(){
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        if($_POST){
            $nama = $_POST['nama_kategori'];
            $admin_id  = $_SESSION['admin_id'];
            if (!empty($nama)){
                if ($this->kategorimodel->cekkategoriada($nama)){
                    $_SESSION['error_msg'] = "Gagal: kategori '<b> $nama</b>'Sudah ada!";
                    header('Location: index.php?act=kategori-tambah');
                    exit;
                }else{
                    $this->kategorimodel->create($nama, $admin_id);
                    $_SESSION['success_msg'] = "Berhasil Tambah Kategori";
                    header("Location: index.php?act=kategori");
                    exit;
                }
            }
        }
    }

 
     public function edit() {
        if(!isset($_SESSION['admin_id'])){
            header('Location: index.php');
            exit;
        }

        $id = isset(($_GET['id'])) ? $_GET['id'] : die('Error ID tidak ada. ');
        $kategori = $this->kategorimodel->getById($id);

        include 'app/views/kategori/edit.php';

    }
   
    public function editproses()
    {
        if (!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        if($_POST){
            $id = $_POST['id'];
            $nama_baru = $_POST['nama_kategori'];

            if(!empty($nama_baru) && !empty($id)){

                $kategori_lama = $this->kategorimodel->getById($id);
                if ($nama_baru !== $kategori_lama['nama_kategori']){

                    if($this->kategorimodel->cekkategoriada($nama_baru)){
                        $_SESSION['error_msg'] = "Gagal update: kategori '<b>$nama_baru<b/>' SUdah digunakan";
                        header("Location: index.php?act=kategori-edit&id=" . $id);
                        exit;
                    }
                }
                $this->kategorimodel->update($id, $nama_baru);
                $_SESSION['sucsess_msg'] = "Berhasil edit kategori";
            }
        }
        header("Location: index.php?act=kategori");
        exit;
    }
   
    public function hapus(){
        if (!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $this->kategorimodel->delete($id);
            $_SESSION['success_msg'] = "Berhasil hapus kategori";
        }
        header("Location: index.php?act=kategori");
        exit;
    }
}
?>