<?php

function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$servername = 'localhost';
$username = 'fosscon';
$password = 'sefri92';
$dbname = 'fosscon';

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die('Connection failed! ' . $con->connect_error);
}


// Check for empty fields
if(empty($_POST['name'])        ||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['stdnum'])      ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
       echo "No arguments Provided!";
       return false;
   }

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$stdnum = $_POST['stdnum'];
$uniqid = generateRandomString();

$query = "select * from users where email='".$email."'";
if ($con->query($query)->num_rows >= 1) {
    die('Email duplicate.');
}

while(true){
    $query = "select * from users where uniqid='".$uniqid."'";
    if ($con->query($query)->num_rows == 0) {
        break;
    }
    $uniqid = generateRandomString();
}

$query = sprintf('insert into users (name, email, phone, stdnum, uniqid) values ("%s", "%s", "%s", "%s", "%s")', $name, $email, $phone, $stdnum, $uniqid);

if ($con->query($query) === true) {
    echo 'query succeed';
} else {
    echo "ERROR: " . $con->error;
}

$con->close();

?>