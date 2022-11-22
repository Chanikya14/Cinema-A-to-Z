<?php 
session_start();


function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

	include("connection.php");

	$user_data = check_login($con);
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
    <title>A to Z: Ratings, Reviews ...</title>
    <script src="switch.js"></script>
<style>
body {
    /* background: linear-gradient(45deg, #141e30 ,  #243b55); */
}
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
.Span {
    background: linear-gradient(45deg, #2193b0,  #6dd5ed);
}
.suii {
    /* background: linear-gradient(45deg, #06beb6 ,  #48b1bf); */
}
.jj {
    background: linear-gradient(45deg, #de6262 ,  #ffb88c);
}
.hsay {
    background: linear-gradient(45deg, #ee9ca7 ,  #ffdde1);
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
      <a class="nav-item nav-link active " href="index.php?username=<?= $user_data['username']; ?>">Search </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link" href="watchlist.php?username=<?= $user_data['username']; ?>">Watchlist </a>
      </li>
      <li class="nav-item">
      <a  class="nav-item nav-link" href="liked.php?username=<?= $user_data['username']; ?>" >Liked </a>
      </li>
      <li class="nav-item">
      <a class="nav-item nav-link" href="watched.php?username=<?= $user_data['username']; ?>">Watched </a>
      </li>   
    </ul>
  </div>  
  <a href = "logout.php"  type="button" class="btn btn-danger">Logout</a>
</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card mt-3">
                    <div class="card-body jj">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control suii" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary Span">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body hsay">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>image</th>
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

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM reviews WHERE CONCAT(movie) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>

                                                    <!-- <td><img src= "" ?></td> -->
                                                    <td>
                                                    <?php
                                                        $link = $items['small_image'];
                                                    ?>
                                                    <img src="<?php echo $link;?>">
                                                    </td>
                                                    <td><?= $items['movie']; ?></td>
                                                    <td><?= $items['year']; ?></td>
                                                    <td><?= $items['rating']; ?></td>
                                                    <td><?= $items['duriation']; ?></td>
                                                    <td><?= $items['genre']; ?></td>
                                                    <td>
                                                    <a href="items-view.php?movie=<?= $items['movie']; ?>&username=<?= $user_data['username']; ?>" class="btn btn-info btn-sm">View</a>

                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
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

<!-- <!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, 
</body>
</html> -->
 