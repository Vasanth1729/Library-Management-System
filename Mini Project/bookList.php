
<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Management System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/bookListStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
                    <a id="inActive" href="addBook.php">Add Books</a>
                    <a id="inActive" href="searchBook.php">Books Search</a>
                    <a id="inActive" href="updateBook.php">Book Update</a>
                    <a id="inActive" href="borrower.php">Issue Book</a>
					<a id="inActive" href="bookSubmission.php">Book Submission</a>
					<a class="active" href="bookList.php">Book List</a>
					<a id="inActive" href="studRecord.php">Student Record</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading"> Book List </h2></center>
				 <?php
					session_start();
					$username = $_SESSION['username'];
					$host = "localhost";
					$dbusername = "root";
					$dbpassword = "";
					$dbname = $username;
					$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
					if(!empty($username)){
						if(mysqli_connect_error())
						{
							die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
						}
						else
						{	
							$result = mysqli_query($conn,"SELECT * FROM bookrecord");
							echo "<table border='1'>
								<tr>
								<th>Book Id</th>
								<th>Title</th>
								<th>Author Name</th>
								<th>Category</th>
								<th>Cost</th>
								<th>Quantity</th>
								</tr>";
							while($row = mysqli_fetch_array($result))
							{
								echo "<tr>";
								echo "<td>" . $row['bookId'] . "</td>";
								echo "<td>" . $row['title'] . "</td>";
								echo "<td>" . $row['authorName'] . "</td>";
								echo "<td>" . $row['category'] . "</td>";
								echo "<td>" . $row['cost'] . "</td>";
								echo "<td>" . $row['quantity'] . "</td>";
								echo "</tr>";
							}
							echo "</table><br><br>";
						}	
					}
					else{
						session_destroy();
						$_SESSION = array();
						header("location: main.html");
					}	
				?> 
            </div>
        </center>    
    </body>
</html>