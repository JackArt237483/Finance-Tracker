<?php
// Подключение базы данных
try {
    $db = new PDO('sqlite:' . __DIR__ . '/../database/data.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Автозагрузка классов
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        die("Класс $class не найден в пути $path");
    }
});

// Подключение библиотек Composer
require __DIR__ . '/../vendor/autoload.php';

use App\Models\CategoryModel;
use App\Models\TransactionModel;
use App\Controllers\CategoryController;
use App\Controllers\TransactionController;
use App\Routes\Routes;

// Инициализация моделей
$categoryModel = new CategoryModel($db);
$transactionModel = new TransactionModel($db);

// Инициализация контроллеров
$categoryController = new CategoryController($categoryModel);
$transactionController = new TransactionController($transactionModel);

// Настройка маршрутов
$router = new Routes();

$router->addRoute('GET', '/categories', function () use ($categoryController) {
    $categories = $categoryController->index();
    $transactions = [];
    require __DIR__ . '/../views/main.php';
});

$router->addRoute('GET', '/transactions', function () use ($transactionController, $categoryController) {
    $categories = $categoryController->index();
    $transactions = $transactionController->index();
    require __DIR__ . '/../views/main.php';
});

$router->addRoute('POST', '/categories/create', function () use ($categoryController) {
    $categoryController->create($_POST['name']);
});

$router->addRoute('POST', '/transactions/create', function () use ($transactionController) {
    $transactionController->create(
        $_POST['amount'],
        $_POST['category_id'],
        $_POST['type'],
        $_POST['description']
    );
});

// Диспетчеризация маршрутов
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$router->dispatch($method, $path);
