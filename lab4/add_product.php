<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $productCode = $_POST['product_code'];
        $productName = $_POST['product_name'];
        $unitPrice = $_POST['unit_price'];

        // Insert new product into the database
        $stmt = $conn->prepare("INSERT INTO products (product_code, product_name, unit_price) VALUES (?, ?, ?)");
        $stmt->execute([$productCode, $productName, $unitPrice]);

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>

    <!-- Form to add a new product -->
    <form method="POST" action="add_product.php">
        <label for="product_code">Product Code:</label>
        <input type="text" name="product_code" required>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="unit_price">Unit Price:</label>
        <input type="text" name="unit_price" required>

        <button type="submit" name="add_product">Add Product</button>
    </form>
</body>
</html>
