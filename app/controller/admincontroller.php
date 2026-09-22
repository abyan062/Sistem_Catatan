<?php
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../models/adminmodel.php';

class admincontroller{
    private $adminmodel;
    private $db;
    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->adminmodel =new adminmodel($this->db);
    }
    //Untuk menampilkan register
    public function viewregister(){
        include __DIR__ . '/../views/auth/register.php';
    }
    // Proses register
    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(strlen($password) < 5){
                $error = "Password kurang dari 5";
            include 'app/views/auth/register.php';
            return;
        }

            if($this->adminmodel->register($username,$password)){
               echo "<script>
                    alert('Registrasi berhasil! Silahkan login.');
                    window.location.href = '/catatan/index.php?act=login';
                  </script>";
            //   header("Location: /catatan/index.php?act=login");
            //     include = 'app/views/admin/login.php';
            } else {
                $error = "Gagal mendaftar. Username mungkin sudah dipakai.";
                include 'app/views/auth/register.php';
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = $this->adminmodel->login($username, $password);

            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['username'] = $admin['username'];
                echo "<script>alert('login berhasil');
                            window.location.href = '/catatan/index.php?act=dashboard';
                        </script>";
                exit;
            } else {
                echo "<script>alert('username atau password salah')</script>";
                include 'app/views/auth/login.php';
            }
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /catatan/index.php');
            exit;
        }

        include 'app/views/dashboard/index.php';
    }

    public function index()
    {
        if(isset($_SESSION['admin_id'])){
            header("Location: index.php?act=dashboard");
            exit;
        }
        include 'app/views/auth/login.php';
    }
    
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
    }


}
?>