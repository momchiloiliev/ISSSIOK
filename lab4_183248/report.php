<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['show_transactions'])) {
        $selectedDate = $_POST['selected_date'];

        $stmt = $conn->prepare("
            SELECT shopping_cart.date_and_time, products.product_name, cart_items.product_amount, 
                   (products.unit_price * cart_items.product_amount) as product_price
            FROM shopping_cart
            JOIN cart_items ON shopping_cart.id = cart_items.cart_id
            JOIN products ON cart_items.product_id = products.id
            WHERE DATE(shopping_cart.date_and_time) = ?
            ORDER BY shopping_cart.date_and_time ASC
        ");
        $stmt->execute([$selectedDate]);
        $transactions = $stmt->fetchAll();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
</head>
<body>
    <h1>Transaction Report</h1>

    <!-- Form to select date and show transactions -->
    <form method="POST" action="report.php">
        <label for="selected_date">Select Date:</label>
        <input type="date" name="selected_date" required>

        <button type="submit" name="show_transactions">Show Transactions</button>
    </form>

    <!-- Display transactions -->
    <?php if (isset($transactions)): ?>
        <h2>Transactions on <?= $selectedDate ?></h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction['date_and_time'] ?></td>
                        <td><?= $transaction['product_name'] ?></td>
                        <td><?= $transaction['product_amount'] ?></td>
                        <td><?= $transaction['product_price'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
