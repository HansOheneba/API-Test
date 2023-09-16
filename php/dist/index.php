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
      <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
      <form action="create.php" method="post">
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
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add
            Product</button>
        </div>
      </form>
    </div>

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
                  <th scope="col" class="px-6 py-4">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "product";

                $conn = mysqli_connect($host, $username, $password, $database);
                if ($conn) {
                  $sql = "select * from product";
                  $res = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($res) != 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
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
                        <td>
                          <a href="update.php?id=<?= $row['id'] ?>"><button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:focus:ring-yellow-900">Update</button></a>
                          <a href="delete.php?id=<?= $row['id'] ?>"><button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button></a>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="script.js"></script>
</body>

</html>