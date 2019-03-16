<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Log In Form</title>
  <meta name="description" content="Log In">
  <meta name="author" content="Thuy Vo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
	<?php
		/*session_start();*/
		$isValid = TRUE;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (empty($_POST['email']) || empty($_POST['password'])){
				$isValid = FALSE;
			}else{

				include('dbconnect.php');
					$sql1="SELECT * FROM user_contact WHERE email=:email AND password=:password";
					$stmt = $conn->prepare($sql1);
                $password =md5(sha1($_POST['password']));
					$stmt->bindParam(":email", $_POST['email']);
					$stmt->bindParam(":password", $password);
					$stmt->execute();
                $arr_session=array();
					if($result = $stmt->fetch(PDO::FETCH_OBJ))
					{
                        $arr_session=array('firstname'=>$result->firstname, 'lastname'=>$result->lastname, 'email'=>$result->email);
					    $user_id = $result->id;
							$email = htmlentities($_POST['email']);
					    $dt = new DateTime();
					    $login_time = $dt->format('Y-m-d H:i:s');
					    $sql2 = "INSERT INTO login (user_id, email, login_time)
				    VALUES ('$user_id', '$email','$login_time')";
					    $conn->query($sql2);
					    echo "<script type='text/javascript'>alert('Successful log in.')</script>";
					    session_start();
							$_SESSION['username'] = $arr_session;
					    header ("Location: home.php");
					}else{
					    echo "<script type='text/javascript'>alert('Credentials were wrong.')</script>";
					}

			}
		}
		if (isset($_SESSION['username']))
		{
			header("Location: home.php");
		}
	?>
	<div id="container">
		<div class="heading">
			<h1>Login Form</h1>
			<ul id="login">
				<?php
					if (!isset($_SESSION['username']))
					{
						print '<li><a href="index.php">Register</a></li>';
						print '<li><a href="login.php">Login</a></li>';
					}
				?>
			</ul>
		</div>
		<br style="clear:both;">

		<form action="login.php" method="post" >
			<fieldset>
				<p>
					 <label></label>
					 <?php
						if(!$isValid){
							print '<h4 class="error-message">Invalid Email or Password</h4>';
						}
					 ?>
				</p>
				<p>
					 <label for="email">Email*:</label>
					 <input type="text" name="email" id="email" value="">
				</p>
				<p>
					 <label for="password">Password*:</label>
					 <input type="password" name="password" id="password" value="">
				</p>
			</fieldset>

			<input type="submit" name="submit" value="Login">
		</form>
	</div>

</body>
</html>
