<?php
class adminmodel{
    private $conn;
    private $table_name = "tb_admin";//nama table
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // public function register($username,$password)
    // {
    //     // fungsi untuk registrasi
    //     $query= " INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
    //     $stmt = $this->conn->prepare($query);
    //     // bersihkan data
    //     $username = htmlspecialchars(strip_tags($username));
    //     // hash untuk password keamana
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //     $stmt->bindParam(":username",$username);
    //     $stmt->bindParam(":password", $hashed_password);
    //     if($stmt->execute()){
    //         return true;
    //     }
    //     return false; 
    // }
    public function register($username, $password)
    {
        try {
            $query = " INSERT INTO " . $this->table_name . "(username, password, created_at) VALUES (:username, :password, :created_at)";
    
            $stmt = $this->conn->prepare($query);
    
            $username =  htmlspecialchars(strip_tags($username));
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            date_default_timezone_set('Asia/Jakarta');
    
            $created_at = date('Y-m-d H:i:s');
    
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":created_at", $created_at);
    
            if($stmt->execute()){
                return true;
            }
    
            return false;

        } catch(PDOException $e) {
            if ($e->getCode() == 23000) {
                return false; // duplicate entry
            }

            throw $e;
        }

    }

    public function login($username,$password)
    {
        // $query = "SELECT id, username, password FROM " . $this->table_name . "WHERE username = :username LIMIT 1";
           $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //verivikasi password hash
            if(password_verify($password, $row['password'])){
                return $row;//kembalikan data admin jika sukses
            }
        }
        return false;
    }
}
?>