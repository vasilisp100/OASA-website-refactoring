<?php

//
// PHP script by: Giorgos Koursiounis (sdi1600077)
//

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
 
if(!isset($_SESSION['loggedin'])){
  header("Location: ../index.php");
  exit;
}

$servername = "localhost";
$server_username = "user";
$server_password = "password";
$dbname = "sdi1600077";

$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$dob = $phone = $user_category = $user_category_id = "";

//create connection
$conn = new mysqli($servername, $server_username, $server_password, $dbname);
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}


//obtain user details
$sql = "SELECT u.phone, u.dob, u.iduser_category, ic.name FROM user u, user_category ic WHERE u.iduser = " . $_SESSION['loggedin'] . " AND u.iduser_category = ic.iduser_category";
$result = $conn->query($sql);

if(!empty($result) && $result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $dob = $row["dob"];
    $phone = $row["phone"];
    $user_category = $row["name"];
    $user_category_id = $row["iduser_category"];
  }
}

$conn->close();

?>
