<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>About Ask One'</title>
    <style>
    .aboutus-area {
        padding-top: 120px;
        padding-bottom: 120px;
    }

    /*-- aboutus Image --*/
    .aboutus-image {
        margin-right: 52px;
        width: 318px;
    }

    @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .aboutus-image {
            margin-right: 35px;
            width: 345px;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .aboutus-image {
            margin-bottom: 30px;
            float: none;
        }
    }

    @media only screen and (max-width: 767px) {
        .aboutus-image {
            margin-bottom: 30px;
            margin-right: 0;
            float: none;
            width: auto;
        }
    }

    .aboutus-image img {
        width: 100%;
    }

    /*-- aboutus Content --*/
    .aboutus-content h1 {
        font-size: 40px;
        font-weight: 800;
        line-height: 40px;
        margin-bottom: 2px;
    }

    @media only screen and (max-width: 479px) {
        .aboutus-content h1 {
            font-size: 30px;
            line-height: 30px;
        }
    }

    .aboutus-content h1 span {
        color: #71b100;
    }

    .aboutus-content h4 {
        font-size: 18px;
        font-weight: 500;
        color: #9b9b9b;
        margin-bottom: 23px;
    }

    .aboutus-content p {
        font-size: 16px;
        line-height: 27px;
    }

    /*-- counter --*/
    .counter {
        border: 1px solid #eeeeee;
        margin-top: 32px;
        float: left;
        width: 100%;
    }

    .counter .single-counter {
        float: left;
        width: 25%;
        padding: 28px 15px 28px;
    }

    @media only screen and (max-width: 767px) {
        .counter .single-counter {
            width: 50%;
        }

        .counter .single-counter:nth-child(3) {
            border-top: 1px solid #eeeeee;
            border-left: 0px solid #eeeeee;
        }

        .counter .single-counter:nth-child(4) {
            border-top: 1px solid #eeeeee;
        }
    }

    .counter .single-counter+.single-counter {
        border-left: 1px solid #eeeeee;
    }

    .counter .single-counter h2 {
        font-size: 30px;
        color: #71b100;
        line-height: 24px;
        font-family: "Open Sans", sans-serif;
        margin-bottom: 8px;
    }

    .counter .single-counter p {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 0;
        color: #8f8f8f;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/justpost">AskOne&#39;</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/justpost">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="about.php"></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Subjects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn,$sql);
            $cnt = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              $cnt++;
              $cat = $row['category_name'];
              $id = $row['category_id'];
        echo '<a class="dropdown-item" href="threadlist.php?catid='.$id.'">'.substr($cat,0,20).'...</a>';
              if($cnt>=4){
                  echo '
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/savan/justpost#cat">More</a>';
              break;
              }
            }
        echo'
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ) {
      echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      <a href="myprofile.php" class="text-light my-0 mx-2" >'.$_SESSION['userName'].'<img class="mx-3" style="height:50px;border: 2px solid white; border-radius:50%;" src="'.$_SESSION['user_image'].'"></a>
      <a href="partials/_logout.php" class="btn btn-success my-2 my-sm-1 ml-1"data-target="#loginModal">Logout</a>
    </form>';
    }
    else{    echo '
    <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="btn-group ml-2">
      <button class="btn btn-success my-2 my-sm-1 ml-1" data-toggle="modal" data-target="#loginModal">Login</button>
    ';}
      echo '
    </div>
  </div>
</nav>
';
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
// Signup alerts
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 1) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 0){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failed!</strong>'.$_GET['showError'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
// Login alerts

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 1) {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You are logged in as <b>'.$_GET['un'].'</b> now you can join the discussions.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 0){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failed!</strong>'.$_GET['msg'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>
    <div class="aboutus-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="aboutus-image float-left hidden-sm">
                            <img src="img/about.png" alt="savan"></div>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="aboutus-content ">
                            <h1>about <span>Ask One'</span></h1>
                            <h4>Details</h4>
                            <p>A website to help each other and Learn togather.
                                Made by <a href="https://www.instagram.com/llll_savan_llll/">Savan Patel</a>.
                                Made using : BOOTSTRAP4 ,PHP.
                                Thanks to : <a href="https://www.codewithharry.com/">Code With Harry</a>.
                                for more information. <a href="">click here.</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script async>(function(w, d) { w.CollectId = "5eef577c1eb3964b6e7c64da"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script> -->
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
</body>

</html>