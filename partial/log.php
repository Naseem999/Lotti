<?php
session_start();
include_once 'head.php';
$Err = "";

if (isset($_POST['login_submit'])) {
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($phone) || empty($pass)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:../login.php?error=$Err");
        exit();
    } else {
        
            $sql = "SELECT * FROM user WHERE phone='$phone';";
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
            if($resultch < 1){
                $Err = "Invalid Login";
                header("Location:../login.php?error=$Err");
                exit();
            }else{
                if ($row = mysqli_fetch_assoc($result)) {    
                    //dehashing of password user type
                    $hashedPwdCheck = password_verify($pass , $row['pass']);
                    if($hashedPwdCheck == false)
                    {
                        $Err = "Invalid Login Password Not matched";
                        header("Location:../login.php?error=$Err");
                    }elseif($hashedPwdCheck == true){
                        //log in the user in website here creating session verible for user
                        $_SESSION['username']=$row['username'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['id']=$row['id'];

                        header("Location:../user_dash.php?login=You Are Logged In Successfully");
                        exit();
                    }
                }
            }
        
    }

  
}

