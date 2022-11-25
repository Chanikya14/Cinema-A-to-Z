<?php 

session_start();

	include("connection.php");

    /**
     * This process will start after the user has entered the information
     */
    if($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

        /**
         * Checking for empty username (or) password
         * Also, making sure that the username is not numeric 
         */
		if(!empty($username) && !empty($password) && !is_numeric($username)) {

			/**
             * Obtaining info from the datbase with the given username
             */
			$query = "select * from users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

				if($result && mysqli_num_rows($result) > 0) {
					$user_data = mysqli_fetch_assoc($result);
                    /**
                     * Verifying the password provided by the user
                     */
					if($user_data['password'] === $password) {
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			    /**
                 * Raising error if the password mismatches with the database data.
                 */
                echo '<script type="text/javascript">
                window.onload = function () { alert("Invalid username or password!!"); }
                </script>'; 
		}
        /**
         * Raising error if the username is numeric.
         */
        else
		{
            echo '<script type="text/javascript">
            window.onload = function () { alert("Username can\'t be numeric :/"); }
            </script>'; 
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1539667547529-84c607280d20?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=861&q=80' );
            background-size: 1300px auto;
            background-repeat: no-repeat;
        }
    </style> 
<form method="post">
    <div class="container">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn"> 
                        <form class="myForm text-center">
                            <header>Log in</header>
                            <div class="form-group">
                                <i class="fas fa-user"></i>
                                <input class="myInput" type="text" placeholder="Username" name="username" required> 

                            </div>
                                 
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" type="password" name="password" placeholder="Password" required> 
                            </div>

                            <input type="submit" class="butt" value="Submit" >
                            <br>
                            Don't have an account?
                            <a id="ran" href = "signup.php" type="submit" class="butt" name="Submit">Register</a>
                            
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="myRightCtn">
                            <div class="box"><header>Cinema A-Z</header>
                            <p>This website created by Lohith,Hemanth & Chanikya<br>
                            This is the course project of CS 251</p>
                                
                            </div>
                        </div> 
                    </div>
                </div> 

            </div>
        </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>