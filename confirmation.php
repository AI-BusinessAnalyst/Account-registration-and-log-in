<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Confirmation Page</title>
  <meta name="description" content="Confirmation Page ">
  <meta name="author" content="Thuy Vo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/confirmation.css">
</head>
<body>
	<div id="container">
		<div class="heading">
			<h1>Confirmation Page</h1>
			<ul id="navigation">
				<li><a href="#" title="Home">Home</a></li>
				<li><a href="#" title="Services">Services</a></li>
				<li><a href="#" title="Blog">Blog</a></li>
				<li><a href="#" title="Aboutus">About Us</a></li>
			</ul>
			<ul id="login">
				<li><a href="index.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
		<hr>

<?php
	include('lib.php');
	session_start();
/*	if (isset($_SESSION['username']))
	{
		echo $_SESSION['username'];
		header("Location: home.php");
	} */
	if (isset($_SESSION['data']))
	{
		// If there were no error, print a success message:
		$dataModel = $_SESSION['data'];

		print '<h2 class="success"> You have been successfully registered.</h2>';
		print '<h3>You have entered the following information:</h3>';
		print '<p>Full Name: ' . $dataModel->firstName . ' ' . $dataModel->lastName .'</p>' ;
		print '<p>Email is: ' . $dataModel->email . '</p>';
		print '<p>Date of birth: ' . $dataModel->getBirthDay(). '</p>';
		print '<p>Address is: ' . $dataModel->address . '</p>';
		print '<p>Postal code is: ' . $dataModel->postalCode . '</p>';
		print '<p>City is: ' . $dataModel->city . '</p>';
		print '<p>Country is: ' . $dataModel->country . '</p>';

		unset ($_SESSION['data']);
	}

?>

			<hr>
	</div>
</body>
</html>
