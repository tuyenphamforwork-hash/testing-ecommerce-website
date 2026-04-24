
<?php
//this all are input validity functions that will provide true/false for error finding 
//in case condition not matched--it executes during signup 

function emptyInputSignup($name, $email,  $number,$address, $pwd,$rpwd){
    $result;
    if (empty($name) ||empty($email) ||empty($number) ||empty($address) ||empty($pwd) ||empty($rpwd) ) {
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}

function invalidPhone($number){
    $result;
    if (strlen($number) < 11) { 
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}

function invalidEmail($email){
    $result;
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {//this return true if var is proper email(built in func)
                 $result = true;   
    }
     else{
                 $result = false;
     }
                 return $result;
}


function pwdMatch($pwd,$rpwd) {
    $result;
    if ($pwd !== $rpwd) {
                 $result = false;   
    }
     else{
                 $result = true;
     }
                 return $result;
}

function invalidPassword($pwd) {
    $result;
    // Check if password is at least 6 characters long
    if (strlen($pwd) < 6) {
        $result = true;
    }
    // Check if password contains at least one letter and one number
    elseif (!preg_match('/[a-zA-Z]/', $pwd) || !preg_match('/[0-9]/', $pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}



function createUser($name,$email,$address,$pwd,$number){
    global $conn;

    if (!isset($conn)) {
        die("Database connection is not available.");
    }

    // Check if email already exists
    if (emailExists($email)) {
        // Store form data in session for repopulation
        $_SESSION['signup_form_data'] = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'number' => $number
        );
        header("location: ../signup.php?error=emailExists");
        exit();
    }

    //using prepare statement for preventing injection
    $sql = $conn->prepare("INSERT INTO customer (customer_fname,customer_email,customer_pwd,customer_phone,customer_address) VALUES (?,?,?,?,?)");
    $sql->bind_param('sssss',$name,$email,$pwd,$number,$address);
    $sql->execute();

    if ($sql->error) {
        die("Database error: " . $sql->error);
    }

    $sql->close();
    header("location: ../index.php?userSuccessfullycreated!loginNow");
    exit;
    }

function emailExists($email){
    global $conn;
    $sql = "SELECT customer_email FROM customer WHERE customer_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return true;
    }else{
        return false;
    }
    $stmt->close();
}
    