<?php
include_once 'head.php';
$Err = "";
if (isset($_POST['signup_submit'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $pass = mysqli_real_escape_string($con, $_POST['pass']);
  $mail = mysqli_real_escape_string($con, $_POST['mail']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $address = mysqli_real_escape_string($con, $_POST['address']);


  if (empty($username) || empty($pass) || empty($mail) || empty($phone) || empty($address)) {
    $Err = "Fill All the Feilds";
    header("Location:../sinup.php?error=$Err");
    exit();
  } else {

    $username = test_input($username);
    // check if Uname only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
      $Err = "Only letters and white space allowed";
      header("Location:../sinup.php?error=$Err");
      exit();
    }

    $mail = test_input($mail);
    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $Err = "Invalid email format";
      header("Location:../sinup.php?error=$Err");
      exit();
    }





    $sql = "SELECT * FROM user  WHERE phone='$phone' ";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
      header("Location:../signup.php?error=User Already exsist");
      exit();
    } else {
      $sql = "SELECT * FROM user  WHERE email='$mail' ";
      $result = mysqli_query($con, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0) {
        header("Location:../signup.php?error=User With Email = $mail Already exsist");
        exit();
      } else {
        //hashing password
        $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
        //INSERT USER INTO DATABASE
        $sql = "INSERT INTO user(username,email,address,phone,pass,balance) VALUES('$username','$mail','$address','$phone','$hashedpwd','0.00');";
        mysqli_query($con, $sql);
        header("Location:../login.php?sucsess");
        exit();
      }
    }
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
