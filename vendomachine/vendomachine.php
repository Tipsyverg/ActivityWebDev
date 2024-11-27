<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        .fset {
            border: 1px solid #dee2e6;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vendo Machine</h2>
        <form method="POST">

            <fieldset class="fset">
                <legend>Products:</legend>             
                <input type="checkbox" name="products[]" value="Coke,15"> Coke - ₱15<br>
                <input type="checkbox" name="products[]" value="Sprite,20"> Sprite - ₱20<br>
                <input type="checkbox" name="products[]" value="Royal,20"> Royal - ₱20<br>
                <input type="checkbox" name="products[]" value="Pepsi,15"> Pepsi - ₱15<br>
                <input type="checkbox" name="products[]" value="Mountain Dew,20"> Mountain Dew - ₱20<br>
            </fieldset>

            <fieldset class="fset">
                <legend>Options:</legend>
                <label for="size">Size: </label>
                <select name="size">
                    <option value="Regular">Regular</option>
                    <option value="Upsize">Upsize (add ₱5)</option>
                    <option value="Jumbo">Jumbo (add ₱10)</option>
                </select>

                <label for="quantity">Quantity: </label>
                <input type="number" name="quantity" id="quantity" value="1" min="1">
                <button type="submit" name="checkout">CheckOut</button>
            </fieldset>
        </form>

        <?php
        if (isset($_POST['checkout'])) {
            // Initialize variables
            $products = isset($_POST['products']) ? $_POST['products'] : [];
            $size = isset($_POST['size']) ? $_POST['size'] : 'Regular';
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

            $totalCost = 0;
            $selectedProducts = [];

            // Loop through selected products
            foreach ($products as $product) {
                list($productName, $productPrice) = explode(",", $product);
                $selectedProducts[] = $productName;
                $totalCost += (int)$productPrice;
            }

            // Calculate additional cost based on size
            if ($size == 'Upsize') {
                $totalCost += 5;
            } elseif ($size == 'Jumbo') {
                $totalCost += 10;
            }

            // Calculate total cost based on quantity
            $totalCost *= $quantity;

            // Display output
            if (count($selectedProducts) > 0 && $quantity > 0) {
                echo "<hr><b>Purchase Summary: </b><br>";
                echo "You ordered: " . implode(", ", $selectedProducts) . "<br>";
                echo "Size: " . htmlspecialchars($size) . "<br>";
                echo "<ul><li>Quantity: {$quantity}</li>";
                echo "<li>Total Cost: ₱" . $totalCost . "</li></ul>";
            } else {
                echo "<hr>No selected products. Please try again.";
            }
        }
        ?>
    </div>
</body>
</html>