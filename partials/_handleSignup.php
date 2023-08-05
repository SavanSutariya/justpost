<?php
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $username = $_POST['username'];
    $username = str_replace("<", "&lt;", "$username");
    $username = str_replace(">", "&gt;", "$username");
    $username = str_replace("'", "&#39;", "$username");
    $username = str_replace("\"", "&#34;", "$username");
    $user_email = $_POST['signupEmail'];
    $user_email = str_replace("<", "&lt;", "$user_email");
    $user_email = str_replace(">", "&gt;", "$user_email");
    $user_email = str_replace("'", "&#39;", "$user_email");
    $user_email = str_replace("\"", "&#34;", "$user_email");
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['csignupPassword'];

    // Check email exist
    $existqry = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn,$existqry);
    $numRows = mysqli_num_rows($result);
    if ($numRows>0) {
        $showError = "Email is already in use";
    }
    else{
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `user_email`, `user_pass`) VALUES ('$username', '$user_email', '$hash')";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                $showAlert = true;
                header("Location: /savan/justpost3/?signupsuccess=1");
                exit();
            }
            else{
                $showError = "qry me problem";
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
header("Location: /savan/justpost3/?signupsuccess=0&showError=$showError");
}

?>