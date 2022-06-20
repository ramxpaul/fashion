<?php
require '../helpers/dbconnection.php';
require '../helpers/functions.php';

### Getting All User Data
$sqlGetData = "select user.user_id,user.f_name,user.l_name,user.email,user.image,roles.role_name from user inner join roles on user.role_id = roles.role_id";
$operation = DoQuery($sqlGetData);
##########


require '../layout/header.php';
require '../layout/nav.php';
require '../layout/sidenav.php';
?>
<!-- Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Users Data</h1>
            <ol class="breadcrumb mb-4">
                <?php
                message('Users/Display');
                ?>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                while($row = mysqli_fetch_assoc($operation)){
                                ?>
                                <tr>
                                    <td><?php echo $row['user_id']?></td>
                                    <td><?php echo $row['f_name']?></td>
                                    <td><?php echo $row['l_name']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><img src="uploads/<?php echo $row['image'] ?>" width="80px" height="80px"></td>
                                    <td><?php echo $row['role_name']?></td>
                                    <td> <a href='edit.php?id=<?php echo $row['user_id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
                                    <td> <a href='delete.php?id=<?php echo $row['user_id'] ?>' class='btn btn-danger m-r-1em'>Delete</a> </td>
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