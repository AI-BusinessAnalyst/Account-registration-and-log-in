<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Edit profile: </title>
  <meta name="description" content="Edit Profile">
  <meta name="author" content="Thuy Vo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
	session_start();
	include('lib.php');
    include('dbconnect.php');
	$hasError = FALSE;
	$hasData = FALSE;
	$dataModel = NULL;
	$errors = NULL;
	if (isset($_SESSION['username'])){// islogin
				$thisUser=addslashes($_SESSION['username']['email']);
				$sql="SELECT * FROM user_contact WHERE email='$thisUser'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id=$row['id'];
        $firstname=$row['firstname'];
        $lastname=$row['lastname'];
        $email=$row['email'];
        $birthdate=$row['birthdate'];
        $str_date= explode('-', $birthdate);
        $birth_year=$str_date[0];
        $birth_mooth=$str_date[1];
        $birth_day=$str_date[2];
        $address=$row['address'];
        $postal_code=$row['postal_code'];
        $city=$row['city'];
        $country=$row['country'];
	}
?>
	<div id="container">
		<div class="heading">
			<h1>User Profile Edit Form</h1>
			<ul id="login">
				<li><a href="home.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>

		<br style="clear:both;">
		<form action="validation_editprofile.php" method="post">
		 <fieldset>
			<legend>Change Profile</legend>
			<h3>Info</h3>
			<p>
				 <label for="firstname">First Name*:</label>
				 <?php
          print '<input type="hidden" name="email" id="email" value="'.$email.'">';
					print '<input type="text" name="firstname" id="firstname" value="'.$firstname.'">';
					if($hasError && !empty($errors->firstName_message)){
						print '<h4 class="error-message">' .$errors->firstName_message. '</h4>';
					}
				 ?>
			</p>
			<p>
				 <label for="lastname">Last Name*:</label>
				  <?php
					print '<input type="text" name="lastname" id="lastname" value="'.$lastname.'">';

					if($hasError && !empty($errors->lastName_message)){
						print '<h4 class="error-message">'.$errors->lastName_message.'</h4>';
					}
				 ?>
			</p>

			<p>
				<label>Date of birth:</label>
				<select name="date">
          <option value="">Day</option>
					<option value="1" <?php if($birth_day=='1') echo 'selected';?>>01</option>
					<option value="2" <?php if($birth_day=='2') echo 'selected';?>>02</option>
					<option value="3" <?php if($birth_day=='3') echo 'selected';?>>03</option>
					<option value="4" <?php if($birth_day=='4') echo 'selected';?>>04</option>
					<option value="5" <?php if($birth_day=='5') echo 'selected';?>>05</option>
					<option value="6" <?php if($birth_day=='6') echo 'selected';?>>06</option>
					<option value="7" <?php if($birth_day=='7') echo 'selected';?>>07</option>
					<option value="8" <?php if($birth_day=='8') echo 'selected';?>>08</option>
					<option value="9" <?php if($birth_day=='9') echo 'selected';?>>09</option>
					<option value="10" <?php if($birth_day=='10') echo 'selected';?>>10</option>
					<option value="11" <?php if($birth_day=='11') echo 'selected';?>>11</option>
					<option value="12" <?php if($birth_day=='12') echo 'selected';?>>12</option>
					<option value="13" <?php if($birth_day=='13') echo 'selected';?>>13</option>
					<option value="14" <?php if($birth_day=='14') echo 'selected';?>>14</option>
					<option value="15" <?php if($birth_day=='15') echo 'selected';?>>15</option>
					<option value="16" <?php if($birth_day=='16') echo 'selected';?>>16</option>
					<option value="17" <?php if($birth_day=='17') echo 'selected';?>>17</option>
					<option value="18" <?php if($birth_day=='18') echo 'selected';?>>18</option>
					<option value="19" <?php if($birth_day=='19') echo 'selected';?>>19</option>
					<option value="20" <?php if($birth_day=='20') echo 'selected';?>>20</option>
					<option value="21" <?php if($birth_day=='21') echo 'selected';?>>21</option>
					<option value="22" <?php if($birth_day=='22') echo 'selected';?>>22</option>
					<option value="23" <?php if($birth_day=='23') echo 'selected';?>>223</option>
					<option value="24" <?php if($birth_day=='24') echo 'selected';?>>24</option>
					<option value="25" <?php if($birth_day=='25') echo 'selected';?>>25</option>
					<option value="26" <?php if($birth_day=='26') echo 'selected';?>>26</option>
					<option value="27" <?php if($birth_day=='27') echo 'selected';?>>27</option>
					<option value="28" <?php if($birth_day=='28') echo 'selected';?>>28</option>
					<option value="29" <?php if($birth_day=='29') echo 'selected';?>>29</option>
					<option value="30" <?php if($birth_day=='30') echo 'selected';?>>30</option>
					<option value="31" <?php if($birth_day=='31') echo 'selected';?>>31</option>
				</select>
			</p>

			<p>
				<label>Month: </label>
				<select name="month">
						<option value="">Month</option>
						<option value="1" <?php if($birth_mooth=='1') echo 'selected';?>>January</option>
						<option value="2" <?php if($birth_mooth=='2') echo 'selected';?>>February</option>
						<option value="3" <?php if($birth_mooth=='3') echo 'selected';?>>March</option>
						<option value="4" <?php if($birth_mooth=='4') echo 'selected';?>>April</option>
						<option value="5" <?php if($birth_mooth=='5') echo 'selected';?>>May</option>
						<option value="6" <?php if($birth_mooth=='6') echo 'selected';?>>June</option>
						<option value="7" <?php if($birth_mooth=='7') echo 'selected';?>>July</option>
						<option value="8" <?php if($birth_mooth=='8') echo 'selected';?>>August</option>
						<option value="9" <?php if($birth_mooth=='9') echo 'selected';?>>September</option>
						<option value="10" <?php if($birth_mooth=='10') echo 'selected';?>>October</option>
						<option value="11" <?php if($birth_mooth=='11') echo 'selected';?>>November</option>
						<option value="12" <?php if($birth_mooth=='12') echo 'selected';?>>December</option>
				</select>
			</p>

			<p>
				<label>Year: </label>
				 <?php
					print '<input type="text" name="year" value="'.$birth_year.'" placeholder="yyyy" size="4">';
					if($hasError && !empty($errors->birthday_message)){
						print '<h4 class="error-message">' .$errors->birthday_message. '</h4>';
					}
				  ?>
			</p>
			<p>
				 <label for="address">Street and address number</label>
				  <?php
					print '<textarea name="address" id="address" cols="15" rows="4">'.$address.'</textarea>';
					if($hasError && !empty($errors->address_message)){
						print '<h4 class="error-message">' .$errors->address_message. '</h4>';
					}
				  ?>
			 </p>
			<p>
				<label for="postal_code">Postal Code: </label>
				 <?php
					print '<input type="text" name="postal_code" id="postal_code" value="'.$postal_code.'">';

					if($hasError && !empty($errors->postalCode_message)){
						print '<h4 class="error-message">' .$errors->postalCode_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="city">City:</label>
				 <?php
					print '<input type="text" name="city" id="city" value="'.$city.'">';

					if($hasError && !empty($errors->city_message)){
						print '<h4 class="error-message">' .$errors->city_message. '</h4>';
					}
				 ?>
			</p>

			<p>
				<label for="country">Country:</label>
				 <?php
					print '<input type="text" name="country" id="country" value="'.$country.'">';

					if($hasError && !empty($errors->country_message)){
						print '<h4 class="error-message">' .$errors->country_message. '</h4>';
					}
				 ?>
			</p>
             <button  name="submit" value="Submit">Update</button>
		 </fieldset>
        </form>
        <form action="validation_editprofile.php" method="post">
            <fieldset>
                <legend>Change Password</legend>
                <p>
                    <label for="password">News Password: </label>
                    <input type="password" name="password" id="password">
                    <?php
                    print '<input type="hidden" name="email" id="email" value="'.$email.'">';
                    if($hasError && !empty($errors->password_message)){
                        print '<h4 class="error-message">' .$errors->password_message. '</h4>';
                    }
                    ?>
                </p>
                <p>
                    <label for="confirm">Confirm Password: </label>
                    <input type="password" name="confirm" id="confirm">
                    <?php
                    if($hasError && !empty($errors->passwordConfirm_message)){
                        print '<h4 class="error-message">' .$errors->passwordConfirm_message. '</h4>';
                    }
                    ?>
                </p>
                <button  name="changepass" value="Change Pass">Change Password</button>
            </fieldset>

	 </form>

        <fieldset>
            <legend>Delete Account</legend>
            <p>
							<label for="password">To delete your account:</label>
						</p>
						<form action="validation_editprofile.php" method="post">
						<p>
						<?php
            print '<input type="hidden" name="id" id="id" value="'.$id.'">';
            ?>
					  </p>
						<p>
						<button  name="del" value="">Delete</button>
						</p>
						</form>
        </fieldset>

       </div>
</body>
</html>
