<?php

//index.php
include 'partials/_dbconnect.php';
session_start();

?>
<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
    $_SESSION['loggedin'] = 1;
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['userName'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
   $_SESSION['userName'] = $data['given_name'].' '.$_SESSION['user_last_name'];
  }

  if(!empty($data['email']))
  {
    $_SESSION['userEmail'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{
    $login_button = '<a class="btn btn-danger" href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ){
    $user_email = $_SESSION['userEmail'];
    $existqry = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn,$existqry);
    $numRows = mysqli_num_rows($result);
    if ($numRows>0) {
        $getInfo = mysqli_query($conn,$existqry);
        $info = mysqli_fetch_assoc($getInfo);
        $_SESSION['user_id'] = $info['sr_no'];
        $_SESSION['time_stamp'] = date("dS M Y l", strtotime($info['timestamp']));
        $_SESSION['user_bio'] = $info['user_bio'];
    }
    else{
        $ins_user_image = $_SESSION['user_image'];
        $ins_user_name = $_SESSION['userName'];
        $ins_user_name = str_replace("<", "&lt;", "$ins_user_name");
        $ins_user_name = str_replace(">", "&gt;", "$ins_user_name");
        $ins_user_name = str_replace("'", "&#39;", "$ins_user_name");
        $ins_user_name = str_replace("\"", "&#34;", "$ins_user_name");
        $insqry = "INSERT INTO `users`(`image`, `username`, `user_email`) VALUES ('$ins_user_image','$ins_user_name','$user_email')";
        $insert = mysqli_query($conn, $insqry);
        if (!$insert) {
            echo 'error in inserting data';
        }
        else{
            $getInfo = mysqli_query($conn,$existqry);
            $info = mysqli_fetch_assoc($getInfo);
            $_SESSION['user_id'] = $info['sr_no'];
            $_SESSION['time_stamp'] = date("d.m.Y H:i:s", strtotime($info['timestamp']));
            $_SESSION['user_bio'] = $info['user_bio'];
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Welcome to Ask One'</title>
    <style>
    * {
        margin: 0;
        padding: 0;
    }

    .fullscreen {
        background: #fff0;
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 20;
    }

    .fullscreen .loader {
        width: 100px;
        margin: auto;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        position: absolute;
        opacity: 1;
    }

    .fullscreen .left {
        position: absolute;
        background: #fff;
        opacity: 1;
        height: 100%;
        left: 0;
        width: 50%;
        transition: .5s;
    }

    .fullscreen .right {
        background: #fff;
        position: absolute;
        opacity: 1;
        right: 0;
        height: 100%;
        width: 50%;
        transition: .5s;
    }
    </style>
</head>

<body onload="loading()">
    <!-- loader -->
    <div class="fullscreen" id="ls">
        <div id="left" class="left"></div>
        <div id="right" class="right"></div>
        <img id="loader" class="loader" src="img/loader.gif" alt="">
    </div>
    <?php include 'partials/_header.php'; ?>
    <!--   Slider   -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider_1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider_2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider_3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- .. Category container .. -->
    <center>
        <div class="container my-4">
            <h2 class="text-center my-3">Sem-3 - Subjects</h2>
            <div class="row" id="cat">
                <?php 
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $cat = $row['category_name'];
              $id = $row['category_id'];
              $desc = $row['category_description'];
              $image = $row['category_image'];
                echo 
                '<div class="col-md-4 my-2">
                  <div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="Image of '.$cat.'">
                    <div class="card-body">
                        <a href="threadlist.php?catid='.$id.'"><h5 class="card-title" >'.$cat.'</h5></a>
                        <p class="card-text">'.substr($desc,0,90).'...</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">Go !nside</a>
                    </div>
                </div>
            </div>
';
            }
?>


            </div>
        </div>
    </center>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <!-- Loader -->
    <script>
    var loader = document.getElementById('loader');
    var left = document.getElementById('left');
    var right = document.getElementById('right');
    var ls = document.getElementById('ls');

    function loading() {
        var t = setTimeout(showPage, 500);
    }

    function showPage() {
        loader.style.opacity = "0";
        left.style.left = "-50%";
        right.style.right = "-50%";
        left.style.opacity = "0";
        right.style.opacity = "0";
        var t = setTimeout(removeLoader, 500);
    }

    function removeLoader() {
        ls.style.display = "none";
    }
    </script>
</body>

</html>