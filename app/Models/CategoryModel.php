<?php
namespace App\Models;

class CategoryModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll();
    }

    public function create($name) {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
?>
