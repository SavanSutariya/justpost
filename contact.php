<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Welcome to JustPost</title>
    <style>
    body {
        background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
    }

    .contact-form {
        background: #fff;
        margin-top: 10%;
        margin-bottom: 5%;
        width: 70%;
    }

    .contact-form .form-control {
        border-radius: 1rem;
    }

    .contact-image {
        text-align: center;
    }

    .contact-image img {
        border-radius: 6rem;
        width: 11%;
        margin-top: -3%;
        transform: rotate(29deg);
    }

    .contact-form form {
        padding: 14%;
    }

    .contact-form form .row {
        margin-bottom: -7%;
    }

    .contact-form h3 {
        margin-bottom: 8%;
        margin-top: -10%;
        text-align: center;
        color: #0062cc;
    }

    .contact-form .btnContact {
        width: 50%;
        border: none;
        border-radius: 1rem;
        padding: 1.5%;
        background: #dc3545;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
    }

    .btnContactSubmit {
        width: 50%;
        border-radius: 1rem;
        padding: 1.5%;
        color: #fff;
        background-color: #0062cc;
        border: none;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/savan/justpost">AskOne&#39;</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/savan/justpost">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php"></a>
      </li>
      <li class="nav-item">
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
      <li class="nav-item active">
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
<!-- <script async>(function(w, d) { w.CollectId = "5eef577c1eb3964b6e7c64da"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script> -->
    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
        </div>
        <form method="post">
            <h3>Drop Us a Message</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *"
                            value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="txtMsg" class="form-control" placeholder="Your Message *"
                            style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
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