<?php
require_once '../functions/functions.php';


// Example product data (this could come from a database)
$products = [
    ['id' => 1, 'name' => 'T-shirt', 'price' => 500],
    ['id' => 2, 'name' => 'Jeans', 'price' => 1200],
    ['id' => 3, 'name' => 'Shoes', 'price' => 2000]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo number_format($product['price'], 2); ?></td>
            <td>
                <form action="payment.php" method="POST">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                    <button type="submit">Buy Now</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
