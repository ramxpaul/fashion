<!-- Code -->
<?php
// DB Connecting
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Fetching Category
$sqlGetCategory = "select category_id , category_name from category";
$result = DoQuery($sqlGetCategory);
#########

### Fetching Users
$sqlGetUser = "select user_id,f_name,l_name from user";
$userResult = DoQuery($sqlGetUser);


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
    if(!validate($price,'required')){
        $errors['price'] = 'Field Required';
    }elseif(!validate($price,'price')){
        $errors['price'] = 'Price Must Be Decimal Number';
    }elseif(!validate($price,'zero')){
        $errors['price'] = 'Product Price never equal zero';
    }elseif(!validate($price,'negative')){
        $errors['price'] = 'Price Must Be Positive Number';
    }

    // Description Validation
    if (!validate($desc, 'required')) {
        $errors['desc'] = 'Please Insert Description for Product';
    } elseif (!validate($desc, 'min',10)) {
        $errors['desc'] = 'Product Description Must be at least 10 letters';
    }

    // Brand Validation
    if (!validate($brand, 'required')) {
        $errors['brand'] = 'Please Insert Product Brand';
    } elseif (!validate($brand, 'min',5)) {
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
            $sqlInsert = "insert into products(product_name,price,brand,description,category_id,user_id) values('$p_name',$price,'$brand','$desc',$category_id,$user_id)";
            $operation = DoQuery($sqlInsert);

            var_dump($operation);
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
            <h1 class="mt-4">Add New Product</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Product/Create')
                ?>
            </ol>


            <div class="container mt-5 mb-5 w-100">
                <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product"  name="name">
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
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value=<?php echo $row['category_id']; ?>><?php echo $row['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>  

                    <div class="input-group mt-5 mb-4 w-100">
                        <label class="input-group-text mr-4 pr-4" for="inputGroupSelect01">Your Name</label>
                        <select class="form-select w-75" required name="user_id">

                            <?php
                            while ($raw = mysqli_fetch_assoc($userResult)) {
                            ?>
                                <option value=<?php echo $raw['user_id']; ?>><?php echo $raw['f_name'].' '.$raw['l_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-primary">Add Product</button>                 
                    
                </form>
            </div>

        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>