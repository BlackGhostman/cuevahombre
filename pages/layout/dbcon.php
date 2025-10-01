<?php
$dbuser = 'u876327316_eaguilar';
$dbpass = 'Peregrino21';
$dbname = 'u876327316_peluqueria';
$con = mysqli_connect("srv1138.hstgr.io",$dbuser,$dbpass,$dbname);




// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }





?>