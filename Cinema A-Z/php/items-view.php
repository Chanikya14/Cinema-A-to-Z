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
    <title>Movie review</title>
<style>
body {
    background-color: black;
}
.poi{
    height: 70%;
    width: 103%;
    margin-left:0%;
    margin-right:20%;
  
}
.hj{
    background: black;
}
.j {
    padding-left: 0px;
    padding-right: 0px; 
}
.ok {
    height: 30%;
}
.hj {
    padding-left: 0px;
    padding-right: 0px; 
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
        <?php
        /**
         * The links in the navbar also contain the username
         */
        ?>
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
                        <?php

                        if(isset($_GET['movie']))
                        {
                            /**
                             * Obtaining info about a particular movie from DB
                             */
                            $movie_name = mysqli_real_escape_string($con, $_GET['movie']);
                            $query = "SELECT * FROM reviews WHERE Name='$movie_name' ";
                            $query_run = mysqli_query($con, $query);
                            ?>
                            <div class="col-md-4">

                            <?php
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $comp_rev = mysqli_fetch_array($query_run);
                                ?>
                                <?php
                                        /**
                                         * For displaying the image
                                         */
                                        $link = $comp_rev['IMAGE'];
                                ?>
                          
                        </div>
                        <div class="col-md-12">
                            <div class="card hj">
                            <div class="card-header">
                                    <h4 style="color: red" >Review Details
                                    </h4>
                                </div>
                                <div class="container-fluid j">
                                  <div class="row j" >
                                    <div class="col-lg-4  ok">
                                        <img class="poi" src="<?php echo $link;?>" >
                                    </div>
                                    <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label style="color: red">Name</label>
                                        <p class="form-control" >
                                            <?=$comp_rev['Name'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >Year</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Year'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >IMDB</label>
                                        <p class="form-control">
                                            <?=$comp_rev['IMDB'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >Metacritic</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Metacritic'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >Tomatometer</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Rotten'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >Duration</label>
                                        
                                        <p class="form-control">
                                            <?=$comp_rev['Duration'];?>
                                        </p>
                                    </div>
                                    <?php
                                    if($comp_rev['Type']=="Movie"){
                                        ?>
                                        <div class="mb-3">
                                        <label style="color: red" >Genre</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Genre'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label style="color: red" >Cast</label>
                                        <p class="form-control">
                                            <?php
                                            /**
                                             * Spliting the string with "," as deliminator
                                             * and eliminating the ladt empty string
                                             * Finally, joining the parts to get the complete cast
                                             */
                                             $ar = explode(",",$comp_rev['Cast']);
                                             array_pop($ar);
                                             $fin = join(",",$ar);
                                             echo $fin;
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                    }
                                    ?>

                            </div>
                            </div>    
                            </div>
                                
                                 
                                <div class="card-body hj">
                                    <?php 
                                    if($comp_rev['Type']!="Movie" ){
                                    ?>
                                <div class="mb-3">
                                        <label style="color: red" >Genre</label>
                                        <p class="form-control">
                                            <?=$comp_rev['Genre'];?>
                                        </p>
                                    </div>
                       
                                    <div class="mb-3">
                                        <label style="color: red" >Cast</label>
                                        <p class="form-control">
                                            <?php
                                             $ar = explode(",",$comp_rev['Cast']);
                                             array_pop($ar);
                                             $fin = join(",",$ar);
                                             echo $fin;
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="mb-3" >
                                        <label style="color: red" > Language</label>
                                        <p class="form-control"  style = "height: auto" rows="2">
                                            <?= $comp_rev['Language']?>
                                        </p>
                                    </div>
                                    <div class="mb-3" >
                                        <label style="color: red" > Plot</label>
                                        <p class="form-control"  style = "height: auto" rows="2">
                                            <?= $comp_rev['Plot']?>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label style="color: red" >Reviews</label>
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                if($arr[0]!=""){
                                                    echo $arr[0];
                                                }
                                        ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                if($arr[1]!=""){
                                                    echo $arr[1];
                                                }
                                    ?>
                                    <div class="mb-3">
                                        <p class="form-control" rows="3">
                                        <?php
                                                $arr = explode('@',$comp_rev['Reviews']);
                                                if($arr[2]!=""){
                                                echo $arr[2];
                                            }
                                    ?>
                                        </p>
                                    </div>
                                    <?php
                                                $arr = explode(',',$comp_rev['Similar']);
                                
                                                
                                    ?>
                                    <div class="mb-3">
                                        <label style="color: red" >Similar movies</label>
                                        <p class="form-control">
                                        <?php 
                                            echo $arr[0];
                                        ?>
                                    </div>
                                   <div class="mb-3">
                                   <?php 
                                        if(!empty($arr[1]))
                                        {
                                            ?>
                                            <p class="form-control">
                                            <?php
                                            echo $arr[1];
                                        }
                                        ?>
                                    </div>        
                                    
                                   <div class="mb-3">
                                        <?php 
                                        if(!empty($arr[2]))
                                        {
                                            ?>
                                            <p class="form-control">
                                            <?php
                                            echo $arr[2];
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    if(isset($_POST['like'])){
                                        /**
                                         * If the user clicks on like,
                                         * Getting the name of the movie and adding the movie into user's liked list
                                         * Taking care of multiple liked movies :)
                                         */
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM liked WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO liked(username,movie) VALUES('$user_name','$movie_name')");
                                        }
                                    }
                                    if(isset($_POST['Add'])){
                                        /**
                                         * If the user clicks on Add,
                                         * Getting the name of the movie and adding the movie into user's Watch list
                                         * Taking care not to add a movie multiple times into the DB :)
                                         */
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM watchlist WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO watchlist(username,movie) VALUES('$user_name','$movie_name')");
                                        }
                                    }
                                    if(isset($_POST['Watched'])){
                                       /**
                                         * If the user clicks on Watched,
                                         * Getting the name of the movie and adding the movie into user's Watched list
                                         * Taking care not to add a movie multiple times into the DB :)
                                         */
                                        $user_name = $_GET['username'];
                                        $movie_name = $_GET['movie'];
                                        $qur = "SELECT * FROM watched WHERE movie = '$movie_name' AND username='$user_name'";
                                        $q_run = mysqli_query($con, $qur);
                                        
                                        if(mysqli_num_rows($q_run)<1){
                                            mysqli_query($con,"INSERT INTO watched(username,movie) VALUES('$user_name','$movie_name')");
                                        }
                                    }
                                    ?>
                                    <form method="post">
                                        <input type="submit" class="btn btn-success btn-sm" name="like" value="Like"></a>
                                        <input type="submit" class="btn btn-success btn-sm" name="Add" value="Add"></a> 
                                        <input type="submit" class="btn btn-success btn-sm" name="Watched" value="Watched"></a><br><br>
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