
<?php 
$conn=mysqli_connect("localhost","root","","spk_metode_saw");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
