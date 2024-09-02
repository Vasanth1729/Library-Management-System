<?php
$username = filter_input(INPUT_POST, 'username');
$password = md5(filter_input(INPUT_POST, 'password'));
session_start();
$_SESSION['username'] = $username;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($username) && !empty($password)){
        $host = "localhost";
        $user = "root";
        $pwd = "";
        $dbname = "vasanth";
        // Create connection
        $conn = new mysqli($host, $user, $pwd, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM adminlogin WHERE  username = '$username' AND  password  = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header('Location: studBookSearch.php');
        } 
        else 
        {
            header('Location: studWrong.php');
        }
        $conn->close();
    }	
}
?>