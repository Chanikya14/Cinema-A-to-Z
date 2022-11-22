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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <title>A to Z: Movie review</title>
<style>
.poi{
    height: 300px;
    margin:auto;
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
      <a class="nav-item nav-link active " href="index.php?username=<?= $_GET['username']; ?>">Search </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link" href="watchlist.php?username=<?= $_GET['username']; ?>">Watchlist </a>
      </li>
      <li class="nav-item">
      <a  class="nav-item nav-link" href="liked.php?username=<?= $_GET['username']; ?>" >Liked </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link" href="watched.php?username=<?= $_GET['username']; ?>">Watched </a>
      </li>   
    </ul>
  </div>  
  <a href = "logout.php"  type="button" class="btn btn-danger">Logout</a>
</nav>


    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Movie review Details
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php

                        if(isset($_GET['movie']))
                        {
                            //  echo $_GET['username'];
                            $movie_name = mysqli_real_escape_string($con, $_GET['movie']);
                            $query = "SELECT * FROM reviews WHERE movie='$movie_name' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $comp_rev = mysqli_fetch_array($query_run);
                                ?>
                                <?php
                                        $link = $comp_rev['IMAGE'];
                                ?>
                                    <img class="poi" src="<?php echo $link;?>"> 
                                    <div class="mb-3">
                                        <label>Movie name</label>
                                        <p class="form-control">
                                            <?=$comp_rev['movie'];?>
            
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Year</label>
                                        <p class="form-control">
                                            <?=$comp_rev['year'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Rating</label>
                                        <p class="form-control">
                                            <?=$comp_rev['rating'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Duration</label>
                                        <p class="form-control">
                                            <?=$comp_rev['duriation'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Genre</label>
                                        <p class="form-control">
                                            <?=$comp_rev['genre'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Meta-scrore</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Meta'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Cast</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Cast'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label>Plot</label>
                                        <p class="form-control"  style = "height: auto" rows="2">
                                            <?= $comp_rev['Plot']?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label>Reviews</label>
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                echo $arr[0]
                                        ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                echo $arr[1]
                                    ?>
                                    <div class="mb-3">
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                echo $arr[2]
                                    ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Similar movies</label>
                                        <p class="form-control">
                                        <?php
                                                $arr = explode(',',$comp_rev['Similar']);
                                                echo $arr[0]
                                    ?>
                                   <div class="mb-3">
                                        <p class="form-control">
                                        <?php
                                                $arr = explode(',',$comp_rev['Similar']);
                                                echo $arr[1]
                                    ?>
                                   <div class="mb-3">
                                        <p class="form-control">
                                        <?php
                                                $arr = explode(',',$comp_rev['Similar']);
                                                echo $arr[2]
                                    ?>
                                    <?php
                                    if(isset($_POST['like'])){
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM liked WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO liked(username,movie) VALUES('$user_name','$movie_name')");
                                        }
                                    }
                                    if(isset($_POST['Add'])){
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM Watchlist WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO Watchlist(username,movie) VALUES('$user_name','$movie_name')");                                           
                                        }
                                    }
                                    if(isset($_POST['Watched'])){
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM Watched WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO Watched(username,movie) VALUES('$user_name','$movie_name')");
                                        }
                                    }
                                    if(isset($_POST['dislike'])){
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "DELETE FROM liked WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);

                                    }
                                    if(isset($_POST['remove'])){
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "DELETE FROM Watchlist WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);

                                    }
                                    ?>
                                    <form method="post">
                                        <input type="submit" class="btn btn-success btn-sm" name="like" value="like"></a>
                                        <input type="submit" class="btn btn-success btn-sm" name="Add" value="Add"></a> 
                                        <input type="submit" class="btn btn-success btn-sm" name="Watched" value="Watched"></a><br><br>
                                        <input type="submit" class="btn btn-danger" name="dislike" value="dislike"></a>
                                        <input type="submit" class="btn btn-danger" name="remove" value="remove"></a>                                       
                                    </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Movie Found</h4>";
                            }
                        }
                        else{echo "error!";}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>