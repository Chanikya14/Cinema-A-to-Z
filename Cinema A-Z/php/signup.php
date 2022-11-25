<?php 
session_start();

	include("connection.php");

	function random_num($length) {

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}

	return $text;
    }

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			/**
			 * Generating rand number for user_id
			 * Searching in the DB for the given username
			 */
			$user_id = random_num(10);
			$name = $username;
			$qry = "SELECT * FROM users WHERE username='$username'";
			
			$q_run = mysqli_query($con,$qry);
			/**
			 * Inserting the user iff the username is free
			 */
			if(mysqli_num_rows($q_run)<1){
			$query = "insert into users (user_id,username,password) values ('$user_id','$username','$password')";

			mysqli_query($con, $query);
			/**
			 * Redirecting to login page after the registration
			 */
			header("Location: login.php");
			die;
			}
			else{
				echo '<script type="text/javascript">
				window.onload = function () { alert("The username is already taken!"); }
				</script>'; 
			}
		}
		else  {
			echo '<script type="text/javascript">
            window.onload = function () { alert("Enter a valid Username and Password"); }
            </script>'; 
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}
	body {
		background-image: url(https://images.unsplash.com/photo-1500622944204-b135684e99fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1461&q=80);
	    
	}
	</style>

  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100" style=" margin-top: 50px">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;" >
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form method = "post">

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg " name="username" placeholder="Username" />
                  <!-- <label class="form-label" for="form3Example1cg">Your Name</label> -->
				  <!-- <input id="text" type="text" name="username" placeholder="Username"><br><br> -->
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password"  placeholder="Password"/>
                  
                </div>


                <div class="d-flex justify-content-center">
                  <input type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Register">
                </div>

                <p class="text-center text-muted mt-5 mb-0">Already a user? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>