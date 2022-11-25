<?php 
session_start();
/**
 * If the user tries to enter the website without entering credentials, it redirects to login page
 *
 * @param [mysqli_connect] $con
 * @return [mysqli_fetch_assoc] $user_data
 */
function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];

		$query = "select * from users where user_id = '$id' limit 1";
        $con = mysqli_connect("localhost","root","","login_sample_db");
		$result = mysqli_query($con,$query);

        /**
         * Checking for the userid in the database
         */

		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	/**
    * If the user is not registered,
    * Redirects to the login page
    */
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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

body {
    background-color: black;
 /* background: linear-gradient(45deg, #ad5389, #3c1053); */
}
.Span {
    background: linear-gradient(45deg, #2193b0,  #6dd5ed);
}
.suii {
    /* background: linear-gradient(45deg, #06beb6 ,  #48b1bf); */
}
.jj {
    background: black;
    padding-left: 10%;
    padding-right: 50%;
}
.hsay {
    
    background: linear-gradient(#FF8C00 ,#40E0D0 );
}
.ya {
    background-color: black;
    padding-top: 0%;
    padding-left: auto;
    
}
.lpp {
    border:none;

}

img:hover {
    transform: scale(1.05);
}
.res {
  
  width: 100%;
  height: auto;

}
.gh {
    padding-bottom: 10%;
    background-color: black;
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

                    <div class="card-body jj">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="GET">
                                    <div class="input-group mb-3 hu">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control suii" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary Span" id="click">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        
            
                                <?php 
                      if(isset($_GET['search']))
                                    {
                                        
                                        ?>
                                        <div class="container ya" id = "dis"><br>
                                        <h2 style = "color: #40E0D0">Search Results</h2>
                                        <div class="row">
                                        <?php
                                        /**
                                         * Gets the word which was searched
                                         * Prints all the movies which has this search-word as a substring
                                         */
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM reviews WHERE CONCAT(Name) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);
                                        ?>
                                        <?php
                                        /**
                                         * If there any movies in the DB which user had searched for..
                                         */
                                        if(mysqli_num_rows($query_run) > 0)
                                        {  
                                            foreach ($query_run as $i) {
                                          ?>
                                            <div class="col-sm-3">
                                            <div class="card gh">
                                                <a href="items-view.php?movie=<?= $i['Name']; ?>&username=<?= $user_data['username'];?>">
                                                    <img class="card-img-top ll" style="height: 350px" src=<?= $i['IMAGE'] ?> alt="Card image">
                                                </a>
                                            </div>
                                            </div>
                                            <?php
                                            }
                                           
                                        }
                                        else {
                                        
                                            ?>
                                                <h2 style="color:white"></h2>
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
            



    <div class="container ya" id = "dis" >
            <br>
            <h2 style = "color: #40E0D0"> Top IMDB Movies</h2>
            <div class="row">
            <?php
            /**
             * Obtaining Top movies from the DB
             */ 
            $con = mysqli_connect("localhost","root","","login_sample_db");
            $qry = "SELECT * FROM reviews WHERE Type = 'Movie'";
            $q_r = mysqli_query($con,$qry);
             $cnt=0;
             /**
              * Printing Top 4 movies in a row
              */
              foreach ($q_r as $i) {
                $h= $i['Name'];
                if($cnt==4) {
                    break;
                }
                $cnt++;
            ?>
  <div class="col-sm-3 ">
    <div class="card ">
        <a href="items-view.php?movie=<?= $i['Name']; ?>&username=<?= $user_data['username'];?>">
            <?php 
            $qry = "SELECT * FROM reviews WHERE Name = '$h'";
            ?>
            <img class="card-img-top ll res" style="" src=<?= $i['IMAGE'] ?> alt="Card image"  >
        </a>
    </div>
  </div>
  <?php
    } ?>

</div>
</div>


<?php 
/**
 * Constructing a array of different genre 
 * And, iterating over the array in the DB
 */
$list = array('Horror','Adventure','Romance','Mystery','Fantasy');
$ct = 0;
while($ct <count($list)){
?>

<div class="container ya" id = "dis" >
            <br>
            <h2 style = "color: #40E0D0"> Top <?php echo $list[$ct] ?> Movies</h2>

            <div class="row">
            <?php 
            /**
             * Obtaining the Movies with the given Genre
             * And, the limit for the number is set to 4
             */
            $j = $list[$ct];
            $qry = "SELECT * FROM reviews WHERE CONCAT(Genre) LIKE '%$j%'";
            $q_r = mysqli_query($con,$qry);
             $cnt=0;
              foreach ($q_r as $i) {
                if($cnt==4) {
                    break;
                }
                $cnt++;
                
            ?>
  <div class="col-sm-3">
    <div class="card gh">
        <a href="items-view.php?movie=<?= $i['Name']; ?>&username=<?= $user_data['username'];?>">
            <img class="card-img-top ll" style="height: 350px" src=<?= $i['IMAGE'] ?> alt="Card image">
        </a>
    </div>
  </div>
    <?php
              }?>

</div>
</div>
<?php
$ct++;
}
?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 