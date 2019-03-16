<?php
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
    if (isset($_POST['firstname'])){
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
    }

    // Validate lastname
    if (isset($_POST['lastname'])){
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
    }

    // Validate password
    if (isset($_POST['password'])){
        if (empty($_POST['password'])) {
            $errors->password_message = "Please enter your password.";
            $errors->count++;
        }
        else if(preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$_POST['password'])){
            $errors->password_message = "Password contains only numbers and letters.";
            $errors->count++;
        }
        else {
            $password =$_POST['password'];
            if ($_POST['password'] != $_POST['confirm']) {
                $errors->passwordConfirm_message = "Your confirmed password does not match the original password.";
                $errors->count++;
            }
        }
    }

    // Validate home address
    if (isset($_POST['address'])){
    if (!empty($_POST['address'])) {
        $dataModel->address = $_POST['address'];
        if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->address)) {
            $errors->address_message = "Address should contain only numbers and letters.";
            $errors->count++;
        }
    }
    }

    //Validate postal code
    if (isset($_POST['postal_code'])){
    if (!empty($_POST['postal_code'])) {
        $dataModel->postalCode = $_POST['postal_code'];
        if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->postalCode)) {
            $errors->postalCode_message = "Postal code should contain only numbers and letters.";
            $errors->count++;
        }
    }
    }

    // Validate city
    if (isset($_POST['city'])){
    if (!empty($_POST['city'])) {
        $dataModel->city = $_POST['city'];
        if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->city )) {
            $errors->city_message = "City should contain only numbers and letters.";
            $errors->count++;
        }
    }
    }

    // Validate country
if (isset($_POST['country'])){
    if (!empty($_POST['country'])) {
        $dataModel->country = $_POST['country'];
        if (preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/",$dataModel->country)) {
            $errors->country_message = "Country should contain only numbers and letters.";
            $errors->count++;
        }

    }
    }

    // Validate day OR month OR year NOT EMPTY
    if (isset($_POST['date']) || isset($_POST['month']) || isset($_POST['year'])){
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
    }

    $dataModel->email=addslashes($_POST['email']);
    $dataModel->birthday_day = isset($_POST['date'])? $_POST['date']:'';
    $dataModel->birthday_month = isset($_POST['month'])? $_POST['month']:'';
    $dataModel->birthday_year = isset($_POST['year'])? $_POST['year']:'';

    /* session created in index.php and again here to scan for user-key, if there is a match, it accesses that session, if not, it starts a new session */
    $_SESSION['data_profile'] = $dataModel;

    if($errors->hasError()){
        $_SESSION['errors'] = $errors;
        header("Location: editprofile.php");
    }else{
        try{
            $birthday = $dataModel->getBirthDay();
            if(isset($_POST['changepass'])){
                $password =md5(sha1($_POST['password']));
                $sql="UPDATE user_contact SET
                `password`='$password'
                 WHERE email='$dataModel->email'";
            }
            elseif(isset($_POST['del'])){ //xóa
                $id=$_POST['id'];
                $sql1="DELETE FROM user_contact WHERE id='$id'";
                if ($conn->query($sql1)==TRUE) {
                  header("Location: index.php");
                  unset($_SESSION['username']);

                } else {
                  echo "Error: " . $sql1 . "<br>" . $conn->error;
                        }
            }
            else{
            $sql="UPDATE user_contact SET
            `firstname`='$dataModel->firstName',
            `lastname`='$dataModel->lastName',
            `birthdate`='$birthday',
            `address`='$dataModel->address',
            `city`='$dataModel->city',
            `country`='$dataModel->country'
            WHERE email='$dataModel->email'";
          }
				if ($conn->query($sql)==TRUE) {
                    header("Location: home.php");
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
