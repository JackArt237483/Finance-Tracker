<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance App</title>
</head>
<body>
<h1>Finance App</h1>

<!-- Add Category Form -->
<form method="POST" action="main.php/categories/create">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Add Category</button>
</form>

<!-- List Categories -->
<h2>Categories</h2>
<?php if (!empty($categories) && is_array($categories)): ?>
    <?php foreach ($categories as $category): ?>
        <p><?= htmlspecialchars($category['name']) ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>No categories found.</p>
<?php endif; ?>

<!-- Add Transaction Form -->
<form method="POST" action="main.php/transactions/create">
    <input type="number" name="amount" placeholder="Amount" required>
    <select name="category_id">
        <?php if (!empty($categories) && is_array($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled>No categories available</option>
        <?php endif; ?>
    </select>
    <select name="type">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Transaction</button>
</form>

<!-- List Transactions -->
<h2>Transactions</h2>
<?php if (!empty($transactions) && is_array($transactions)): ?>
    <?php foreach ($transactions as $transaction): ?>
        <p>ID: <?= $transaction['id'] ?> - Amount: <?= $transaction['amount'] ?> -
            Category: <?= htmlspecialchars($transaction['category_name']) ?> -
            Type: <?= $transaction['type'] ?> -
            Date: <?= $transaction['date'] ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>No transactions found.</p>
<?php endif; ?>
</body>
</html>
