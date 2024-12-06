<?php
namespace App\controllers;

use App\Models\CategoryModel;

class CategoryController {
    private $categoryModel;

    public function __construct(CategoryModel $categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    public function index() {
        return $this->categoryModel->getAll();
    }

    public function create($name) {
        $this->categoryModel->create($name);
        header('Location: /categories');
    }
}
?>
