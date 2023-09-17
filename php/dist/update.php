<?php
if (empty($_REQUEST['id'])) {
    header("Location: index.php?status=failed&&message=No ID specified for request");
    exit();
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="output.css" rel="stylesheet">
    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 1s ease-out;
        }
    </style>
    <title>Products UI</title>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto my-8 ">
        <?php
        if (!empty($_REQUEST['status']) && !empty($_REQUEST['message'])) {
            if ($_REQUEST['status'] == "success") {
                ?>
                <div id="message"
                    class=" font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100">
                    <?= $_REQUEST['message'] ?>
                </div>
                <?php
            } else {
                ?>
                <div id="message"
                    class="font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100">
                    <?= $_REQUEST['message'] ?>
                </div>
                <?php
            }
        }
        ?>
        <div class="max-w-md mx-auto my-10 bg-white p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Update Product</h2>
            <form action="update.php" method="post">
                <div class="mb-4">
                    <label for="id" class="block text-gray-700 font-medium mb-2">ID</label>
                    <input type="text" name="id" value="<?= $_REQUEST['id'] ?>" id="id" disabled
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input type="text" name="name" id="name" 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Product Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                    <input type="number" name="price" id="price" step="0.01"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mt-6">
                    <button type="submit" name="btn_update"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update
                        Product</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

if (isset($_POST['btn_update'])) {
    $status = "failed";
    $message = "Unknown";
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "product";

        $conn = mysqli_connect($host, $username, $password, $database);
        if ($conn) {
            $sql = "UPDATE product SET name = '" . $name . "', description = '" . $description . "', price = '" . $price . "' WHERE id = '" . $id . "'";
            
            if (mysqli_query($conn, $sql)) {
                if (mysqli_affected_rows($conn)) {
                    $status = "success";
                    $message = "Product updated successfully";
                } else {
                    $message = "No changes made to the product";
                }
            } else {
                $message = "Failed to execute SQL query: " . mysqli_error($conn);
            }
        } else {
            $message = "Failed to connect to the database: " . mysqli_connect_error();
        }
    } else {
        $message = "All fields are required";
    }

    header("Location: index.php?status=" . $status . "&&message=" . $message);
    exit();
}


?>