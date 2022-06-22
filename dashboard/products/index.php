<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Getting Specific User Data 
$sqlGetProducts = "select products.product_id,products.product_name,products.price,products.brand,products.description,category.category_name,user.f_name,user.l_name from products inner join category on products.category_id = category.category_id inner join user on products.user_id = user.user_id";

$operation = DoQuery($sqlGetProducts);
##########


require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>
<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products Data</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Products/Display');
                ?>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Products Table
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                     <th>#</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Admin Name</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Admin Name</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($operation)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['product_id']; ?></td>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['brand']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td><?php echo $row['f_name'].' '.$row['l_name']  ?></td>
                                        <td> <a href='edit.php?id=<?php echo $row['product_id'] ?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
                                        <td> <a href='delete.php?id=<?php echo $row['product_id'] ?>' class='btn btn-danger m-r-1em'>Delete</a> </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
    <?php
    require '../layout/footer.php';
    ?>