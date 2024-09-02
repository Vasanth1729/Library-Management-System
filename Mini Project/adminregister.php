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
							    echo 'Successfully Registered' ;
								header('Location: login.html');

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
			$conn1 = new mysqli($host, $dbusername, $dbpassword);
			if(mysqli_connect_error())
			{
				die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
			}
			else
			{
				$sql = "CREATE Database $username";	
				if($conn1->query($sql))
				{
					//echo "New Database Created Successfully";
					$sql1 = "USE $username";
					$sql2 = "CREATE TABLE bookRecord (bookId varchar(10) PRIMARY KEY, title varchar(50), authorName varchar(40),category varchar(40), cost int(8), quantity int(5))";
					$sql3 = "CREATE TABLE studentDetail (username varchar(30) PRIMARY KEY, password varchar(40))";
					$sql4 = "CREATE TABLE borrower (studUsername varchar(30), bookId varchar(10), issueDate DATE, returnDate DATE)";
					if($conn1->query($sql1) && $conn1->query($sql2) && $conn1->query($sql3) && $conn1->query($sql4)){
						echo "<center><p >Table Successfully Created</p></center>";
					}
					else
					{
						echo $conn1->error;
					}
				}
				else
				{
					echo $conn1->error;
				}
				$conn1->close();
			}			
		}
	}
	
?>