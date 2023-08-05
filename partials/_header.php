<?php

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/savan/justpost">AskOne&#39;</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/justpost">Home <span class="sr-only">(current)</span></a>
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
<!-- <script async>(function(w, d) { w.CollectId = "5eef577c1eb3964b6e7c64da"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script> -->