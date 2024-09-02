<?php
$username = filter_input(INPUT_POST, 'username');
$email =filter_input(INPUT_POST,'email');
$password = md5(filter_input(INPUT_POST, 'password'));
$confirmPassword = md5(filter_input(INPUT_POST, 'confirmPassword'));
$entry = "unsuccess";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($username)){
        if(!empty($password))
        {
            if($password != $confirmPassword){	
                echo '<script language="javascript">';
                echo 'alert("Password and confirm password must be same")';
                echo '</script>';
                die();
            }
            else
            {
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "vasanth";
                $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
                if(mysqli_connect_error())
                {
                    die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
                }	
                else
                {	
                        $sql = "INSERT INTO adminlogin (username, password,email)
                        values('$username', '$password','$email');";
                        if($conn->query($sql))
                        {
                            $entry = "success";
                            $adminname="vkr";
                            echo 'Successfully Registered' ;
                            header('Location: stdLogin.html');

                        }
                        else
                        {
                            echo "Error: ". $sql ."<br>". $conn->error;
                        }	
                        $conn->close();
                }
            }
        }	
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Password is empty")';
            echo '</script>';
        }	
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Username is empty")';
        echo '</script>';
        die();
    }
    if($entry == "success")
		{
			$host = "localhost";
			$dbusername = "root";
			$dbpassword = "";
			$dbname = $adminname;
			$conn1 = new mysqli($host, $dbusername, $dbpassword, $dbname);
			if(mysqli_connect_error())
			{
				die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
			}
			else
			{	
                $sql1 = "INSERT INTO studentdetail (username, password) values('$username', '$password');";
				if($conn1->query($sql1)){
					echo "Data Successfully Inserted";
			
				}
				else
				{
					echo "Error: ". $sql1 ."<br>". $conn1->error;
				}
			}			
		}
	}
?>