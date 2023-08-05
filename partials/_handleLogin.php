<?php
$msg= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    
    $sql = "Select * from users where user_email = '$email'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows < 1) {
        $msg = "No account found!";
        header("Location: /savan/justpost3/?loginsuccess=0&msg=$msg");
        exit();
    }
    elseif ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = 1;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userName'] = $row['username'];
            $_SESSION['user_id'] = $row['sr_no'];
            $un = $_SESSION['userName'];
            header("Location: /savan/justpost3/?loginsuccess=1&un=$un");
            exit();
            }
        $msg = "Wrong Password";
        header("Location: /savan/justpost3/?loginsuccess=0&msg=$msg");
    }
    
}


?>