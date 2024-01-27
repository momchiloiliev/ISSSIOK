<?php
include 'config.php';


if (!isset($_SESSION['cart_id'])) {
    $stmt = $conn->prepare("INSERT INTO shopping_cart (date_and_time) VALUES (NOW())");
    $stmt->execute();
    $_SESSION['cart_id'] = $conn->lastInsertId();
}

$cart_id = $_SESSION['cart_id'];

// Handle adding products to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_basket'])) {
        $productCode = $_POST['product_code'];
        $quantity = $_POST['quantity'];

        // Check if the product exists
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_code = ?");
        $stmt->execute([$productCode]);
        $product = $stmt->fetch();

        if ($product) {
            $productPrice = $quantity * $product['unit_price'];

            // Add product to the basket (cart_items table)
            $stmt = $conn->prepare("INSERT INTO cart_items (product_id, cart_id, product_amount) VALUES (?, ?, ?)");
            $stmt->execute([$product['id'], $_SESSION['cart_id'], $quantity]);

            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "Product with code $productCode does not exist.";
        }
    }
}

// Fetch cart items for display
$stmt = $conn->prepare("
    SELECT products.product_name, products.unit_price, cart_items.product_amount, 
           (products.unit_price * cart_items.product_amount) as product_price
    FROM cart_items
    JOIN products ON cart_items.product_id = products.id
    WHERE cart_items.cart_id = ?
");
$stmt->execute([$_SESSION['cart_id']]);
$cartItems = $stmt->fetchAll();

// Fetch total price
$stmt = $conn->prepare("SELECT * FROM shopping_cart WHERE id = ?");
$stmt->execute([$_SESSION['cart_id']]);
$totalPrice = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Checkout</title>
</head>
<body>
    <h1>Supermarket Checkout</h1>

    <!-- Form to add products to the basket -->
    <form method="POST" action="index.php">
        <label for="product_code">Product Code:</label>
        <input type="text" name="product_code" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <button type="submit" name="add_to_basket">Add to Basket</button>
    </form>

    <?php
    // Display error message if any
    if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>

    <!-- Display basket items -->
    <h2>Basket</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $conn->prepare("SELECT p.product_name, p.unit_price, ci.product_amount, (p.unit_price * ci.product_amount) as total_price
                                FROM cart_items ci
                                JOIN products p ON ci.product_id = p.id
                                WHERE ci.cart_id = :cart_id");
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->execute();
    $basketItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($basketItems as $item): ?>
                <tr>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= $item['unit_price'] ?></td>
                    <td><?= $item['product_amount'] ?></td>
                    <td><?= $item['total_price'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Display total price -->
    <h3>Total Price: <?= array_sum(array_column($cartItems, 'product_price')) ?></h3>

    <!-- Payment buttons -->
    <form method="POST" action="payment.php">
    <input type="hidden" name="cart_id" value="<?= $cart_id ?>">
        <button type="submit" name="cash">Pay by Cash</button>
        <button type="submit" name="card">Pay by Card</button>
    </form>
</body>
</html>
