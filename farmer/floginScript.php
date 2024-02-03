<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

require('../sql.php'); // Includes Login Script
 
if(isset($_POST ['farmerlogin'])) {
  $farmer_email=$_POST['farmer_email'];
  $farmer_password=$_POST['farmer_password'];
  $farmer_phone=$_POST['farmer_phone'];
  //$farmer_password=SHA1($farmer_password);


  $farmerquery = "SELECT * from `farmerlogin` where email='".$farmer_email."' and password='".$farmer_password."' ";
  $result = mysqli_query($conn, $farmerquery);
  $rowcount=mysqli_num_rows($result);

  $farmerquery1 = "SELECT * from `farmerlogin` where phone_no='".$farmer_phone."' and password='".$farmer_password."' ";
  $result1 = mysqli_query($conn, $farmerquery1);
  $rowcount1=mysqli_num_rows($result1);
  if ($rowcount==true || $rowcount1==true) {
    $_SESSION['farmer_login_user']=$farmer_email; // Initializing Session
    

    header("location: ftwostep.php"); // Redirecting To Other Page
    } 
    else  {
       $error = "Username or Password is invalid";
     }
    
 mysqli_close($conn); // Closing Connection

}

?>
