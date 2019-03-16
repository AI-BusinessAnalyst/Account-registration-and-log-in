<?php
session_start();
	include('lib.php');
	include('dbconnect.php');
	/* script receives eight values from the index.html page */
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errors = new ErrorModel();
	    $errors->count = 0;

		$dataModel = new DataModel();


		// Flag variable to track success
		$password = "";

		// Validate firstname
		if (empty($_POST['firstname'])) {
			$errors->firstName_message = "Please enter your first name.";
			$errors->count++;
		}
		else{
			$dataModel->firstName=$_POST['firstname'];
			if (ctype_alpha($_POST['firstname']) == FALSE) {
				$errors->firstName_message = "Only characters are allowed.";
				$errors->count++;
			}
		}

		// Validate lastname
		if (empty($_POST['lastname'])) {
				$errors->lastName_message = "Please enter your last name.";
				$errors->count++;
		}
		else{
			$dataModel->lastName=$_POST['lastname'];
			if (ctype_alpha($_POST['lastname']) == FALSE) {
				$errors->lastName_message = "Only characters are allowed.";
				$errors->count++;
			}
		}

		// Validate if email exists
		if (empty($_POST['email'])) {
			$errors->email_message = "Please enter your email.";
			$errors->count++;
		}
		else {
			$dataModel->email = $_POST['email'];
			if (!filter_var($dataModel->email, FILTER_VALIDATE_EMAIL)){
				$errors->email_message = "This is an invalid email address.";
				$errors->count++;
			}else{
				$sql1 = "SELECT * FROM user_contact WHERE email = :email";
				$stmt = $conn->prepare($sql1);
				$stmt->bindParam(':email', $dataModel->email);
                $stmt->execute();
				if ($result=$stmt->fetch(PDO::FETCH_OBJ))
				    {
					$errors->email_message = "Email already exists";
					$errors->count++;
				}
				
			}
		}

		// Validate password
		if (empty($_POST['password'])) {
			$errors->password_message = "Please enter your password.";
			$errors->count++;
		}
		else if(preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$_POST['password'])){
			$errors->password_message = "Password contains only numbers and letters.";
			$errors->count++;
		}
		else {
			$password = $_POST['password'];
			if ($_POST['password'] != $_POST['confirm']) {
				$errors->passwordConfirm_message = "Your confirmed password does not match the original password.";
				$errors->count++;
			}
		}


		// Validate home address
		if (!empty($_POST['address'])) {
			$dataModel->address = $_POST['address'];
			if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->address)) {
				$errors->address_message = "Address should contain only numbers and letters.";
				$errors->count++;
			}
		}

		//Validate postal code
		if (!empty($_POST['postal_code'])) {
			$dataModel->postalCode = $_POST['postal_code'];
			if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->postalCode)) {
				$errors->postalCode_message = "Postal code should contain only numbers and letters.";
				$errors->count++;
			}
		}

		// Validate city
		if (!empty($_POST['city'])) {
			$dataModel->city = $_POST['city'];
			if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->city )) {
				$errors->city_message = "City should contain only numbers and letters.";
				$errors->count++;
			}
		}

		// Validate country
		if (!empty($_POST['country'])) {
			$dataModel->country = $_POST['country'];
			if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->country)) {
				$errors->country_message = "Country should contain only numbers and letters.";
				$errors->count++;
			}

		}

		// Validate day OR month OR year NOT EMPTY
	    if (empty ($_POST['date']) || empty ($_POST['month']) || empty ($_POST['year'])) {
			$errors->birthday_message = "Please input Date-Month-Year";
			$errors->count++;
		}
		else {
			if (!is_numeric($_POST['year']) || $_POST['year'] > 2017) {
				$errors->birthday_message = "Please select the year as four digits";
				$errors->count++;
			}
		}
		$dataModel->birthday_day = $_POST['date'];
		$dataModel->birthday_month = $_POST['month'];
		$dataModel->birthday_year = $_POST['year'];

		/* Thuy: session created in index.php and again here to scan for user-key, if there is a match, it accesses that session, if not, it starts a new session */
		$_SESSION['data'] = $dataModel;

		if($errors->hasError()){

			$_SESSION['errors'] = $errors;
			header("Location: index.php");
		}else{
			try{
				$birthday = $dataModel->getBirthDay();
                $password =md5(sha1($password));
				$sql2 = "INSERT INTO user_contact (firstname, lastname, email, password, birthdate, address, postal_code, city, country)
				VALUES ('$dataModel->firstName', '$dataModel->lastName','$dataModel->email', '$password', '$birthday', '$dataModel->address', '$dataModel->postalCode', '$dataModel->city', '$dataModel->country')";

				if ($conn->query($sql2)==TRUE) {
					header("Location: confirmation.php");
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
			}
			catch(Exception $e){
				 echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		exit();
	}
?>
