    <?php 
    include 'partials/_dbconnect.php'; 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id`= $id";
    $result = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    session_start();
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

        <title>Ask One' - <?php echo $catname; ?></title>
        <style>
        #que {
            min-height: 430px;
        }

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
            transition: .5s;
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
        @media only screen and (max-width: 768px){
            .catname{
                font-size:1.5rem !important;
            }
            .catdesc{
                font-size:1rem !important;
            }
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


        <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if( $method == 'POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", "$th_title");
        $th_title = str_replace(">", "&gt;", "$th_title");
        $th_title = str_replace("'", "&#39;", "$th_title");
        $th_title = str_replace("\"", "&#34;", "$th_title");

        $th_desc = str_replace("<", "&lt;", "$th_desc");
        $th_desc = str_replace(">", "&gt;", "$th_desc");
        $th_desc = str_replace("'", "&#39;", "$th_desc");
        $th_desc = str_replace("\"", "&#34;", "$th_desc");
        $id = $_GET['catid'];
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_user_id`, `thread_category_id`) VALUES ('$th_title','$th_desc',$user_id,$id)";
        $insert = mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Your thread has been added successfully!</strong> Please wait for comunity to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>
        <!-- .. Category container .. -->
        <div class="container my-4">
            <div class="jumbotron">
                <h1 class="display-4 catname">Welcome to <?php echo $catname; ?> posts</h1>
                <p class="lead catdesc"><?php echo $catdesc; ?></p>
                <hr class="my-4">
                <p>Let's learn Togather || This is a page to share knowledge to each other
                    <br>
                    Post in relevant sub-forums only.<br>
                    Messages posted in the wrong topic area will be removed and placed in the correct sub-forum by
                    moderators.<br>
            </div>
        </div>
        <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1 ) {
        echo '
        <div class="container">
        <h1 class="py-2">Ask your question</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="title">Your problem title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
            </div>
            
            <div class="form-group">
                <label for="desc">Elaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
        ';
    }
    else{
        echo '
        <div class="container">
            <h1 class="py-2">Ask your question</h1>
            <p class="lead">You are not logged in! please login to join the discussions.</p>
        </div>
        ';
    }
    ?>
        <div class="container mb-5" id="que">
            <h1 class="py-2">Questions</h1>
            <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE `thread_category_id`= $id";
    $result = mysqli_query($conn,$sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $th_id = $row['thread_id'];
        $thread_time = $row['time_stamp'];
        $user_id = $row['thread_user_id'];
        $sql2 = "SELECT username FROM `users` where sr_no=$user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
    
       echo'
             <div class="media my-3">
                <img src="img/user-default.png" width="64px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['username'].' at '.$thread_time.'</p>
                    <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$th_id.'">'.$title.'</a></h5>
                    '.$desc.'
                </div>
            </div>';
    }
    if($noResult == true){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads Found!</p>
          <p class="lead">Be the first person to ask a question.</p>
        </div>
      </div>';
    }
        ?>


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