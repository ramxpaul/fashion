<?php
### Clean Function 

function clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}

### Validation Function To Validate Data
function validate($input, $case, $length = 6)
{
    $status = true;

    switch ($case) {
        case 'required':
            if (empty($input)) {
                $status = false;
            }
            break;

        case 'email':
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $status = false;
            }
            break;
        case 'min':
            if (strlen($input) < $length) {
                $status = false;
            }
            break;
        case 'max':
            if (strlen($input) > $length) {
                $status = false;
            }
            break;
        case 'int':
            if (!filter_var($input, FILTER_VALIDATE_INT)) {
                $status = false;
            }
            break;
        case 'image':
            // Validatating Extension
            $imageType = $input;
            $extensionArray = explode('/', $imageType);
            $extensions = strtolower(end($extensionArray));
            $allowedExtensions = ['jpeg', 'jpg', 'png', 'gift'];

            if (!in_array($extensions, $allowedExtensions)) {
                $status = false;
            }
            break;
            //prices validation
        case 'price':
            if (!filter_var($input, FILTER_VALIDATE_FLOAT)) {
                $status = false;
            }
            break;
        case 'zero':
            if ($input == 0) {
                $status = false;
            }
            break;
        case 'negative':
            if ($input < 0) {
                $status = false;
            }
    }

    return $status;
}

### Print Messages That Will be Save to Session
function message($message = null)
{
    if (isset($_SESSION['message'])) {
        foreach ($_SESSION['message'] as $Mkey => $Mvalue) {
            //printing
            echo $Mkey . ' : ' . $Mvalue . '<br>';
        }
        unset($_SESSION['message']);
    } else {
        echo ' <li class="breadcrumb-item active">' . $message . '</li>';
    }
}

### DB Queries Function
function DoQuery($query)
{
    $result = mysqli_query($GLOBALS['conn'], $query);
    return $result;
}

### Upload
function upload($file)
{
    $extensionArray = explode('/', $file['image']['type']);
    $extension =  strtolower(end($extensionArray));
    # Upload Image . . .
    $finalName = uniqid() . time() . '.' . $extension;
    $disPath = 'uploads/' . $finalName;
    # Get Temp Path . . .
    $tempName  = $file['image']['tmp_name'];

    if (move_uploaded_file($tempName, $disPath)) {
        return $finalName;
    } else {
        return false;
    }
}

function proImage($file)
{
    $extensionArray = explode('/', $file['image']['type']);
    $extension =  strtolower(end($extensionArray));
    # Upload Image . . .
    $finalName = uniqid() . time() . '.' . $extension;
    $disPath = 'uploads/' . $finalName;
    # Get Temp Path . . .
    $tempName  = $file['image']['tmp_name'];

    if (move_uploaded_file($tempName, $disPath)) {
        return $finalName;
    } else {
        return false;
    }
}

### Removing File
function RemoveFile($file)
{
    $filePath = 'uploads/' . $file;
    if (file_exists($filePath)) {
        unlink($filePath);
        $status = true;
    } else {
        $status = false;
    }
    return $status;
}

function url($input){

    return   'http://'.$_SERVER['HTTP_HOST'].'/fashion/dashboard/'.$input;    
   } 
     function checkOwner($id){
   
        if(($_SESSION['user']['role_id'] == 5) && ($_SESSION['user']['user_id'] != $id)){
        
               $status = false; 
        
           }else{
               $status = true; 
           }
   
           return $status; 
     }