<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching products
$sqlGetProducts = "select product_id , product_name from products";
$result = DoQuery($sqlGetProducts);
$test = mysqli_fetch_assoc($result);
#########

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $pro_id = (int)clean($_POST['product_id']);
    
$errors=[];

// Role_ID Validation
if (!validate($pro_id, 'required')) {
    $errors['pro_id'] = "product is Required";
} elseif (!validate($pro_id, 'int')) {
    $errors['pro_id'] = "Invalid Product ID";
}

// if (!Validate($_FILES['image']['name'], 'required')) {
//     $errors['Image'] = "Field Required";
//   } elseif (!Validate($_FILES['image']['type'], 'image')) {
//     $errors['Image'] = "Invalid Extension";
//   }

  if (count($errors) > 0) {
    $_SESSION['message'] = $errors;
  } else {

    # Upload File 
    if (!empty($_FILES['image']['name'])) {

        $tempName  = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];

        // $extensionArray = explode('/', $imageType[0]);
        $extension =  strtolower( end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp']; 

        if (in_array($extension, $allowedExtensions)) {

            // $finalName = $test['product_id'].'-'.uniqid() . time() . '.' . $extension;
            // $images = explode('-',$finalName);
            // echo $images[0];

            $disPath = 'uploads/' . $finalName;

                if (move_uploaded_file($tempName, $disPath)) {
                $sql = "insert into product_images (image,product_id) values('$finalName',$pro_id)";
                $op  = DoQuery($sql);
          
                if ($op) {
                  $message = ['success' => 'Article Added Successfully'];
                } else {
                  $message = ['error' => 'Error Adding Article'];
                }
            } else {
                echo 'File Uploaded Failed';
            }
        } else {
            echo 'File Type Not Allowed';
        }
    } else {
        echo 'Please Select File';
    }

      
    }


    $_SESSION['Message'] = $message;
  }

require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>

<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add Product Images</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Product/Images')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-4 w-100">
                        <label class="input-group-text mr-4 pr-4" for="inputGroupSelect01">Products</label>
                        <select class="form-select w-75" name="product_id">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value=<?php echo $row['product_id']; ?>><?php echo $row['product_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Image Upload</label>
                        <input type="file" name="image[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>

        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>