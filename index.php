<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Registration Page</title>
  <meta name="description" content="Registration Page">
  <meta name="author" content="Thuy Vo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
	include('lib.php');

	// start a session
	session_start();

	$hasError = FALSE;
	$hasData = FALSE;
	$dataModel = NULL;
	$errors = NULL;
	if (isset($_SESSION['errors']))
	{
		$errors = $_SESSION['errors'];
		$hasError = $errors->hasError();
		unset($_SESSION['errors']);
	}

	if(is_null($errors)){
		$hasError = FALSE;
	}

	if (isset($_SESSION['data']))
	{
		$dataModel = $_SESSION['data'];
		$hasData = TRUE;
		unset ($_SESSION['data']);
	}

	if(is_null($dataModel)){
		$hasData = FALSE;
	}
?>
	<div id="container">
		<div class="heading">
			<h1>Registration Form</h1>
			<ul id="login">
				<li><a href="index.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
		<br style="clear:both;">
		<form action="validation.php" method="post">
		 <fieldset>
			<legend>Your Contact Details</legend>
			<p>
				 <label for="firstname">First Name*:</label>
				 <?php
					$temp = '';
					if($hasData && !empty($dataModel->firstName)){
						$temp = $dataModel->firstName;
					}
					print '<input type="text" name="firstname" id="firstname" value="'.$temp.'">';
					/* Repeat wrong entered text */
					if($hasError && !empty($errors->firstName_message)){
						print '<h4 class="error-message">' .$errors->firstName_message. '</h4>';
					}
				 ?>
			</p>
			<p>
				 <label for="lastname">Last Name*:</label>
				  <?php
				  	$temp = '';
					if($hasData && !empty($dataModel->lastName)){
						$temp = $dataModel->lastName;
					}
					print '<input type="text" name="lastname" id="lastname" value="'.$temp.'">';

					if($hasError && !empty($errors->lastName_message)){
						print '<h4 class="error-message">'.$errors->lastName_message.'</h4>';
					}
				 ?>
			</p>
			<p>
				<label for="email">Email*:</label>

				  <?php
				  	$temp = '';
					if($hasData && !empty($dataModel->email)){
						$temp = $dataModel->email;
					}
					print '<input type="text" name="email" id="email" value="'.$temp.'">';

					if($hasError && !empty($errors->email_message)){
						print '<h4 class="error-message">' .$errors->email_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="password">Password*: </label>
				<input type="password" name="password" id="password">
				 <?php
					if($hasError && !empty($errors->password_message)){
						print '<h4 class="error-message">' .$errors->password_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="confirm">Confirm Password*: </label>
				<input type="password" name="confirm" id="confirm">
				 <?php
					if($hasError && !empty($errors->passwordConfirm_message)){
						print '<h4 class="error-message">' .$errors->passwordConfirm_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label>Date of birth:</label>
				<select name="date">
					<option value="">Day</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
			</p>

			<p>
				<label>Month: </label>
				<select name="month">
						<option value="">Month</option>
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
				</select>
			</p>

			<p>
				<label>Year: </label>

				 <?php
					$temp = '';
					if($hasData && !empty($dataModel->birthday_year)){
						$temp = $dataModel->birthday_year;
					}
					print '<input type="text" name="year" value="'.$temp.'" placeholder="yyyy" size="4">';

					if($hasError && !empty($errors->birthday_message)){
						print '<h4 class="error-message">' .$errors->birthday_message. '</h4>';
					}
				  ?>
			</p>
			<p><b>* Required field</b></p>
		</fieldset>

		<fieldset>
			<legend>Address</legend>
		    <p>
				 <label for="address">Street and number</label>
				  <?php
				  	$temp = '';
					if($hasData && !empty($dataModel->address)){
						$temp = $dataModel->address;
					}
					print '<textarea name="address" id="address" cols="15" rows="4">'.$temp.'</textarea>';
					if($hasError && !empty($errors->address_message)){
						print '<h4 class="error-message">' .$errors->address_message. '</h4>';
					}
				  ?>
			 </p>
			<p>
				<label for="postal_code">Postal Code: </label>
				 <?php
				 	$temp = '';
					if($hasData && !empty($dataModel->postalCode)){
						$temp = $dataModel->postalCode;
					}
					print '<input type="text" name="postal_code" id="postal_code" value="'.$temp.'">';

					if($hasError && !empty($errors->postalCode_message)){
						print '<h4 class="error-message">' .$errors->postalCode_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="city">City:</label>
				 <?php
				  	$temp = '';
					if($hasData && !empty($dataModel->city)){
						$temp = $dataModel->city;
					}
					print '<input type="text" name="city" id="city" value="'.$temp.'">';

					if($hasError && !empty($errors->city_message)){
						print '<h4 class="error-message">' .$errors->city_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="country">Country:</label>
				 <?php
				  	$temp = '';
					if($hasData && !empty($dataModel->country)){
						$temp = $dataModel->country;
					}
					print '<input type="text" name="country" id="country" value="'.$temp.'">';

					if($hasError && !empty($errors->country_message)){
						print '<h4 class="error-message">' .$errors->country_message. '</h4>';
					}
				 ?>
			</p>
		 </fieldset>

		 <input type="submit" name="submit" value="Submit">
	 </form>

	</div>
</body>
</html>
