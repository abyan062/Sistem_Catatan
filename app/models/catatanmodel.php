<?php
class catatanmodel{
    private $conn;
    private $table_name = "tb_catatan";
    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        // $query = "SELECT c.*, k.nama_kategori, a.username AS nama_admin FROM ".$this->table_name . "c LEFT JOIN kategori k ON.kategori_id = k.id JOIN admin a ON c.admin_id = a.id ORDER BY c.id DESC";
        $query = "SELECT c.*, k.nama_kategori, a.username AS nama_admin 
          FROM " . $this->table_name . " c
          LEFT JOIN tb_kategori k ON c.kategori_id = k.id
          JOIN tb_admin a ON c.admin_id = a.id
          ORDER BY c.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($judul, $isi, $kategori_id, $admin_id){
        $query = "INSERT INTO " .$this->table_name ."(judul, isi, kategori_id, admin_id) VALUES(:judul, :isi, :kategori_id, :admin_id)";
        $stmt = $this->conn->prepare($query);

        $judul = htmlspecialchars(strip_tags($judul));
        $isi = htmlspecialchars(strip_tags($isi));

        $kategori_id = !empty($kategori_id) ? $kategori_id : NULL;

        $stmt->bindParam(":judul", $judul);        
        $stmt->bindParam(":isi", $isi);
        $stmt->bindParam(":kategori_id", $kategori_id);
        $stmt->bindParam(":admin_id", $admin_id);
        
        return $stmt->execute();
    }

    public function getById($id){
        $query = "SELECT * FROM " .$this->table_name ." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $judul, $isi, $kategori_id){
        $query = "UPDATE " .$this->table_name ." SET judul = :judul, isi = :isi, kategori_id = :kategori_id WHERE id = :id ";
        $stmt = $this->conn->prepare($query);

        $judul = htmlspecialchars(strip_tags($judul));
        $isi = htmlspecialchars(strip_tags($isi));
        $kategori_id = !empty($kategori_id) ? $kategori_id : NULL;

$stmt->bindParam(":judul", $judul);
$stmt->bindParam(":isi", $isi);
$stmt->bindParam(":kategori_id", $kategori_id);
$stmt->bindParam(":id", $id);

    return $stmt->execute();
    }

   public function delete($id){
    $query = "DELETE FROM " .$this->table_name ." WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id" , $id);
    return $stmt->execute();

   }
}
?>