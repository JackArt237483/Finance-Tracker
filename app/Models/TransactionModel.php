<?php
namespace App\Models;

use PDO;

class TransactionModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create($amount, $category_id, $type, $description) {
        $stmt = $this->db->prepare(
            "INSERT INTO transactions (amount, category_id, type, description, date) 
            VALUES (:amount, :category_id, :type, :description, :date)"
        );
        $date = date('Y-m-d H:i:s');
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    }

    public function getAll() {
        $stmt = $this->db->query(
            "SELECT t.*, c.name AS category_name 
             FROM transactions t 
             JOIN categories c ON t.category_id = c.id 
             ORDER BY t.date DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
