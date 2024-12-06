<?php
namespace App\controllers;

use App\Models\TransactionModel;

class TransactionController {
    private $transactionModel;

    public function __construct(TransactionModel $transactionModel) {
        $this->transactionModel = $transactionModel;
    }

    public function index() {
        return $this->transactionModel->getAll();
        require_once  '../views/main.php';
    }

    public function create($amount, $category_id, $type, $description) {
        $this->transactionModel->create($amount, $category_id, $type, $description);
        header('Location: main.php/transactions');
    }
}
?>
