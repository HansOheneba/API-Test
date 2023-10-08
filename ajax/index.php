<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="output.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    .fade-out {
      opacity: 0;
      transition: opacity 1s ease-out;
    }
  </style>
  <title>Products AJAX</title>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto my-8 ">
  <h2 class="text-2xl font-semibold mb-4">Products</h2>
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
   

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full border border-gray-500 text-left text-sm font-light bg-white shadow-md rounded-md">
              <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                  <th scope="col" class="px-6 py-4">ID</th>
                  <th scope="col" class="px-6 py-4">Name</th>
                  <th scope="col" class="px-6 py-4">Description</th>
                  <th scope="col" class="px-6 py-4">Price</th>
                  <th scope="col" class="px-6 py-4">Date Created</th>
                  <th scope="col" class="px-6 py-4">Date Modified</th>
        
                </tr>
              </thead>
              <tbody>
                <?php
                require_once 'db.php';

                try {
                  $sql = "SELECT * FROM product";
                  $stmt = $db->query($sql);

                  if ($stmt->rowCount() != 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr class="border-b dark:border-neutral-500">
                        <th class="whitespace-nowrap px-6 py-4 font-medium">
                          <?= $row['id'] ?>
                        </th>
                        <td class="whitespace-nowrap px-6 py-4">
                          <?= $row['name'] ?>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <?= $row['description'] ?>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <?= $row['price'] ?>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <?= $row['dateCreated'] ?>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                          <?= $row['dateModified'] ?>
                        </td>
                       
                      </tr>
                      <?php
                    }
                  }
                } catch (PDOException $e) {
                  echo "Database Error: " . $e->getMessage();
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="max-w-md mx-auto my-10 bg-white p-6 rounded-md shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
      <form action="http://localhost/APIs/API%20Test/ajax/product/create" method="post">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
          <input type="text" name="name" id="name"
            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-medium mb-2">Product Description</label>
          <textarea name="description" id="description" rows="4"
            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required></textarea>
        </div>
        <div class="mb-4">
          <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
          <input type="number" name="price" id="price" step="0.01"
            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mt-6">
        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add Product</button>
    </div>
      </form>
    </div>
  </div>
</body>

</html>