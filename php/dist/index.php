<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="output.css" rel="stylesheet">
</head>
<body>
   
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full text-left text-sm font-light">
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-4">ID</th>
              <th scope="col" class="px-6 py-4">Name</th>
              <th scope="col" class="px-6 py-4">Discription</th>
              <th scope="col" class="px-6 py-4">Price</th>
              <th scope="col" class="px-6 py-4">Date Created</th>
              <th scope="col" class="px-6 py-4">Date Modified</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $host = "localhost"; 
            $username = "root";
            $password = ""; 
            $database = "product"; 
            
            $conn = mysqli_connect($host, $username, $password, $database);
            if($conn){
                $sql = "select * from products";
                $res = mysqli_query($conn, $sql); 
                if (mysqli_num_rows($res) != 0){
                    while ($row = mysqli_fetch_assoc($res)){
                        ?>
                         <tr class="border-b dark:border-neutral-500">
              <th class="whitespace-nowrap px-6 py-4 font-medium"><?=$row['id']?></th>
              <td class="whitespace-nowrap px-6 py-4"><?=$row['name']?></td>
              <td class="whitespace-nowrap px-6 py-4"><?=$row['description']?></td>
              <td class="whitespace-nowrap px-6 py-4"><?=$row['price']?></td>
              <td class="whitespace-nowrap px-6 py-4"><?=$row['dateCreated']?></td>
              <td class="whitespace-nowrap px-6 py-4"><?=$row['dateModified']?></td>
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
  
</body>
</html>