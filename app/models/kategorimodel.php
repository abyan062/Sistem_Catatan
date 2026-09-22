<?php
    class kategorimodel{
        private $conn;
        private $table_name = "tb_kategori";
        
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAll(){
            $query = "SELECT tb_kategori.* , tb_admin.username AS nama_admin FROM ".$this->table_name." 
            JOIN tb_admin on tb_kategori.admin_id = tb_admin.id 
            ORDER BY tb_kategori.id DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cekkategoriada($nama_kategori){
            $query ="SELECT id FROM " .$this->table_name ." WHERE nama_kategori = :nama LIMIT 1";
            $stmt = $this->conn->prepare($query);

            $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));
            $stmt->bindParam(":nama", $nama_kategori);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }
            return false;
        }

        public function create($nama_kategori,$admin_id){
            $query = "INSERT INTO ".$this->table_name."(nama_kategori, admin_id) VALUES (:nama, :admin_id)";
            $stmt = $this->conn->prepare($query);
            
            $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));
            $stmt->bindParam(":nama", $nama_kategori);
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
        public function update($id, $nama_kategori) {
        $query = " UPDATE " . $this->table_name . " SET nama_kategori = :kategori WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));

        $stmt->bindParam(':kategori', $nama_kategori);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
     }
      public function delete($id){
        $query = "DELETE FROM " .$this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }
    }
?>