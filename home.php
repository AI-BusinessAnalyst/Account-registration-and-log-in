<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome Page</title>
  <meta name="description" content="Welcome Page">
  <meta name="author" content="Thuy Vo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/home.css">
</head>
<body>
	<div id="container">
		<div class="heading">
			<h1>Home Page</h1>
			<ul id="login">
				<?php
					session_start();
                function getAccount($conn,$email){
                    $sql="SELECT * FROM user_contact WHERE email='$email'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $row;
                }
                include('dbconnect.php');
                $email=$_SESSION['username']['email'];
                $thisAccount=getAccount($conn,$email);  /* $thisAccount = bool(false) */
                $firstName=$thisAccount['firstname'];

          if (!isset($_SESSION['username']))
					{


						print '<li><a href="index.php">Register</a></li>';
            print '<li><a href="login.php">Login</a></li>';
					}else{


						print '<li><a href="editprofile.php">Edit profile: '.$firstName.'</a></li>';
						print '<li><a href="logout.php">Logout</a></li>';
					}
				?>
			</ul>
		</div>
		<hr>
		<div id="leftcol">
			<?php
      print '<h2>Welcome '.$firstName.'</h2>';

      ?>
			<hr>
		</div>
	</div>
</body>
</html>
