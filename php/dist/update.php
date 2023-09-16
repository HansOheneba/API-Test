<?php
if (empty($_REQUEST['id'])) {
    header(header: "location: index.php?status=failed&&message=no ID specified for request");
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
            /* Adjust the duration and timing function as needed */
        }
    </style>
    <title>Products CRUD</title>
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
            <form action="update.php?id=<?= $_REQUEST['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
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
$status = "failed";
$message = "Unknown";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['btn_update'])) {
    // Check if the required fields are not empty
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
        $id = $_POST['id']; // Get the product ID from the form
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "product";

        $conn = mysqli_connect($host, $username, $password, $database);
        if ($conn) {
            // Prepare and execute the SQL query to update the product
            $sql = "UPDATE product SET name=?, description=?, price=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssdi", $name, $description, $price, $id);

            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_affected_rows($conn) > 0) {
                    $status = "Success";
                    $message = "Product Updated Successfully";
                } else {
                    $message = "No product found with the provided ID";
                }
            } else {
                $message = "Failed to update product";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            $message = "Failed to connect to the database";
        }
    } else {
        $message = "All fields are required";
    }
}

header("location: index.php?status=" . $status . "&message=" . $message);
?>