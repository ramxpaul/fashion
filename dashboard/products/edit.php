<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching Category
$sqlGetCategory = "select * from category";
$catResult = DoQuery($sqlGetCategory);
#########

### Fetching Users
$sqlGetUser = "select * from user";
$userResult = DoQuery($sqlGetUser);
###########

### Getting Products Data
$id = $_GET['id'];
$sqlGetProducts = "select * from products where product_id=$id";
$op= DoQuery($sqlGetProducts);
$productData = mysqli_fetch_assoc($op);


// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ### Create user code structure
    $p_name = clean($_POST['name']);
    $price = (float)clean($_POST['price']);
    $brand = clean($_POST['brand']);
    $desc = clean($_POST['desc']);
    $category_id = (int)clean($_POST['category_id']);
    $user_id = (int)clean($_POST['user_id']);

    // Validations
    $errors = [];

    // Product Name Validation
    if (!validate($p_name, 'required')) {
        $errors['name'] = 'Please Insert Product';
    } elseif (!validate($p_name, 'min', 3)) {
        $errors['name'] = 'Product Name must be at Least 3 letters';
    }

    // Price Validation
    if (!validate($price, 'required')) {
        $errors['price'] = 'Field Required';
    } elseif (!validate($price, 'price')) {
        $errors['price'] = 'Price Must Be Decimal Number';
    } elseif (!validate($price, 'zero')) {
        $errors['price'] = 'Product Price never equal zero';
    } elseif (!validate($price, 'negative')) {
        $errors['price'] = 'Price Must Be Positive Number';
    }

    // Description Validation
    if (!validate($desc, 'required')) {
        $errors['desc'] = 'Please Insert Description for Product';
    } elseif (!validate($desc, 'min', 10)) {
        $errors['desc'] = 'Product Description Must be at least 10 letters';
    }

    // Brand Validation
    if (!validate($brand, 'required')) {
        $errors['brand'] = 'Please Insert Product Brand';
    } elseif (!validate($brand, 'min', 5)) {
        $errors['brand'] = 'Product Brand Must be at least 5 letters';
    }

    // category_id Validation
    if (!validate($category_id, 'required')) {
        $errors['category_id'] = "Category is Required";
    } elseif (!validate($category_id, 'int')) {
        $errors['category_id'] = "Invalid Category ID";
    }

    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
        $sqlUpdate = "update products set product_name='$p_name',price=$price,brand='$brand',description='$desc',category_id=$category_id,user_id=$user_id where product_id=$id";
        $operation = DoQuery($sqlUpdate);

        if ($operation) {
            $message = ['Success' => 'Product Created Successfully'];
            header('Location: index.php');
        } else {
            $message = ['Error' => 'error occurred while Adding New Product'];
        }
        $_SESSION['message'] = $message;
    }
}


### Design -->

require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>

<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Product/Update')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputBrand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="exampleInputBrand" placeholder="Enter Brand" name="brand">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="exampleInputPrice" name="price">
                    </div>
                    <div class="form-floating">
                        <label for="floatingTextarea2">Description</label>
                        <textarea class="form-control" placeholder="Product Info . . . " id="floatingTextarea2" name="desc" style="height: 100px"></textarea>
                    </div>

                    <div class="input-group mt-5 mb-4 w-100">
                        <label class="input-group-text mr-4 pr-4" for="inputGroupSelect01">Category</label>
                        <select class="form-select w-75" required name="category_id">

                            <?php
                            while ($cat = mysqli_fetch_assoc($catResult)) {
                            ?>
                            <option value=<?php if($cat['category_id'] == $productData['category_id']){echo 'selected';} ?>><?php echo $cat['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-group mt-5 mb-4 w-100">
                        <label class="input-group-text mr-4 pr-4" for="inputGroupSelect01">Your Name</label>
                        <select class="form-select w-75" required name="user_id">

                            <?php
                            while ($user = mysqli_fetch_assoc($userResult)) {
                            ?>
                                <option value=<?php if($user['user_id'] == $productData['user_id']){echo 'selected';} ?>><?php echo $user['f_name'] . ' ' . $user['l_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Product</button>

                </form>
            </div>

        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>