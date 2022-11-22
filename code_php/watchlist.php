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
    <title>A to Z: Watchlist</title>
<style>
.col {
  float: right;
  width: 90%;
  margin: 0 90% ;
  padding: 0 50px;
  margin-top: 6px;
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
      <a  class="nav-item nav-link" href="liked.php?username=<?= $_GET['username']; ?>" >Liked </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link " href="watched.php?username=<?= $_GET['username']; ?>">Watched </a>
      </li>   
    </ul>
  </div>  
  <a href = "logout.php"  type="button" class="btn btn-danger">Logout</a>
</nav>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>movie</th>
                                    <th>year</th>
                                    <th>rating</th>
                                    <th>duriation</th>
                                    <th>genre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","login_sample_db");

                                    if(isset($_GET['username']))
                                    {
                                        $user = $_GET['username'];
                                        $query = "SELECT * FROM watchlist WHERE username='$user'";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                 $movie = $items['movie'];
                                                $new_query = "SELECT * FROM reviews WHERE movie = '$movie'";
                                                $q_run = mysqli_query($con,$new_query);
                                                $abc = $q_run;
                                                foreach($q_run as $abc){
                                                ?>
                                                <tr>
                                                    <td><?= $abc['movie']; ?></td>
                                                    <td><?= $abc['year']; ?></td>
                                                    <td><?= $abc['rating']; ?></td>
                                                    <td><?= $abc['duriation']; ?></td>
                                                    <td><?= $abc['genre']; ?></td>
                                                    <td>
                                                    <a href="items-view.php?movie=<?= $abc['movie']; ?>&username=<?= $_GET['username']; ?>" class="btn btn-info btn-sm">View</a>

                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="6">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>