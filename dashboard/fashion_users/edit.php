<?php
$id = $_GET['id'];
$sqlGetUser = "select * from user where user_id=$id";
$op = DoQuery($sqlGetUser);
$userData = mysqli_fetch_assoc($op);


// Create Structure Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ### Create user code structure
    $fName = clean($_POST['fName']);
    $lName = clean($_POST['lName']);
    $email = clean($_POST['email']);
    $role_id = (int)clean($_POST['role_id']);

    // Validations
    $errors = [];

    // First Name Validation
    if (!validate($fName, 'required')) {
        $errors['fName'] = 'Please Insert Your First Name';
    } elseif (!validate($fName, 'max', 8)) {
        $errors['fName'] = 'First Name Must Be less Than 8 Letters';
    }

    // Last Name Validation
    if (!validate($lName, 'required')) {
        $errors['lName'] = 'Please Insert Your Last Name';
    } elseif (!validate($fName, 'max', 8)) {
        $errors['lName'] = 'Last Name Must Be less Than 8 Letters';
    }

    // Email Validation
    if (!validate($email, 'required')) {
        $errors['email'] = 'Please Insert Your Email Address';
    } elseif (!validate($email, 'email')) {
        $errors['email'] = 'Invalid Email';
    }

    // Role_ID Validation
    if (!validate($role_id, 'required')) {
        $errors['role_id'] = "Role is Required";
    } elseif (!validate($role_id, 'int')) {
        $errors['role_id'] = "Invalid Role ID";
    }

    // Catching errors
    if (count($errors) > 0) {
        // print errors 
        $_SESSION['message'] = $errors;
    } else {
        if(validate($_FILES['image']['name'],'required')){
            $imageName = upload($_FILES);
        }else{
            $imageName = $userData['image'];
        }

        $sqlEdit = "update user set f_name='$fName' , l_name='$lName',email='$email',image='$imageName',role_id=$role_id where user_id=$id";
        $operation = DoQuery($sqlEdit);

        if ($operation) {
            $message = ['Success' => 'User Data Updated Successfully'];
            $_SESSION['message'] = $message;
            header("Location: index.php");
            exit(); // stop the script

        } else {
            $message = ['error' => 'Error Occurred While Editting User Data, Please Try Again '];
            $_SESSION['message'] = $message;
        }
    }
}



### Design -->
require '../fashion_layout/header.php';
require '../fashion_layout/nav.php';
?>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="First Name"></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" value="" placeholder="Last Name"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="example@ex.com"></div>
                </div>
               
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php
    require '../fashion_layout/footer.php';
?>