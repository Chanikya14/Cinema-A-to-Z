<?php
    include("connection.php");
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>A-Z: Liked Movies</title>
<style>
.col {
  float: right;
  width: 90%;
  margin: 0 90% ;
  padding: 0 50px;
  margin-top: 6px;
}
img:hover {
    transform: scale(1.02);
}
.button {
  text-align:center;
   background-color:red; 
   width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0px;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; remove underline from anchors 
}
body {
    background: black;
}
.ii {
    background: linear-gradient(45deg, #ff4500, #ffd700);   
}
.gh {
    background-color: black;
}
.butt {
   margin-left: 10%;
   margin-right: 5%;
}
.bh {
    margin-left:12%;
}
</style>
</head>
<body>

<nav id="navbar" class="navbar navbar-expand-md bg-dark navbar-dark">
<a class="navbar-brand" href="#" ><img width = "75"  src="a2z.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-item nav-link " href="index.php?username=<?= $_GET['username']; ?>">Search </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link active" href="watchlist.php?username=<?= $_GET['username']; ?>">Watchlist </a>
      </li>
      <li class="nav-item">
      <a  class="nav-item nav-link " href="liked.php?username=<?= $_GET['username']; ?>" >Liked </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link " href="watched.php?username=<?= $_GET['username']; ?>">Watched </a>
      </li>   
    </ul>
  </div>  
  <a href = "logout.php"  type="button" class="btn btn-danger">Logout</a>
</nav>

    
                                <?php 
                                    $con = mysqli_connect("localhost","root","","login_sample_db");

                                    if(isset($_GET['username']))
                                    {
                                        $user = $_GET['username'];
                                        /**
                                         * If the user wants to remove from liked,
                                         * we obtain the movie name by removing "@" from the value
                                         * After getting the name, we simply run the DELETE query
                                         */
                                        if(isset($_POST['Remove'])){
                                                    
                                            $user_name = $_GET['username'];
                                            $movie_name = $_POST['Remove'];
                                            $arr = explode("@",$movie_name);
                                            $movie_name = join(" ",$arr);
                                            
                                            $qur = "DELETE FROM watchlist WHERE movie = '$movie_name' AND username='$user_name'";
                                            $q_run = mysqli_query($con, $qur);
                                        
                                        }
                                        /**
                                         * Obtaining all the liked movies by the user from the DB
                                         */
                                        ?>

                                        <div class="container ya" id = "dis"><br>
                                        <h2 style = "color: #40E0D0">Watchlist</h2>
                                        <div class="row"> 
                                        <?php
                                        $r = $_GET['username'];
                                        $query = "SELECT * from watchlist WHERE username= '$r'";
                                        $query_run = mysqli_query($con,$query);
                                        /**
                                         * If there are any like movies at all
                                         */
                                        if(mysqli_num_rows($query_run) > 0)
                                        {  
                                            foreach ($query_run as $a) {
                                                /**
                                                 * Getting all the info of the movie from the reviews table
                                                 */
                                                $nm = $a['movie'];
                                                $q = "SELECT * FROM reviews WHERE Name='$nm'";
                                                $oj = mysqli_query($con,$q);
                                                foreach($oj as $i){
                                          ?>
                                            <div class="col-sm-3">
                                            <div class="card gh">
                                                <a href="items-view.php?movie=<?= $i['Name']; ?>&username=<?= $_GET['username'];?>">
                                                    <img class="card-img-top ll" style="height: 350px" src=<?= $i['IMAGE'] ?> alt="Card image">
                                                </a>
                                                <div class="card-body">
                                                <form method="post">
                                                    <?php
                                                        /**
                                                         * space-seperated movie names are joined with "@"
                                                         * The final concatenated string is passed as the value of the button 
                                                         */
                                                         $fg = $i['Name'];
                                                         $arr = explode(" ",$fg);
                                                         $joined = join("@",$arr);
                                                         /**
                                                          * View button to view complete details
                                                          * Dislike button if the user didn't like the movie :/
                                                          */
                                                         ?> 
                                                         <a href="items-view.php?movie=<?= $i['Name']; ?>&username=<?= $_GET['username']; ?>" class="btn btn-success bh">View</a>
                                                         <button class="btn btn-danger butt" value= <?=$joined?> name='Remove'> Remove</button>
                                                         
                                                   </form>
                                                </div>
                                            </div>
                                            </div>
                                            <?php
                                            }
                                        }
                                        }
                                        else {
                                        
                                            ?>
                                                <h2 style="color:white"></h2>
                                            <?php
                                        }
                                    }
                                ?>
                            
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>