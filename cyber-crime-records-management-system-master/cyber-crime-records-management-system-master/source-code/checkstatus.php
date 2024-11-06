<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}

// define variables and set to empty values
$successMsg = $errorMsg = $status = $statusErr = "";
$statusresult = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["status"])) {
    $statusErr = "Complaint ID is required";
  } else {
    $status = test_input($_POST["status"]);
    // check if subject only contains letters and whitespace
    if (!preg_match("/^C[0-9]{3}$/",$status)) {
      $statusErr = "Complaint ID format is Invalid."; 
    }
  }
}

if (!empty($_POST["status"]) && $statusErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    
    $sql = "SELECT * from complaint WHERE c_id = '$status'";
	$result=$conn->query($sql);
    if ($result->num_rows > 0) {
        $successMsg = "Please find the status of the given Complaint ID below";
		$statusresult = "<table border='2' style='width: 100%; border-collapse: collapse; margin-top: 20px; float: left;'>
		<tr><th>Complaint ID</th><th>Category</th><th>Category Description</th><th>Bureau Location</th><th>Subject</th><th>Details</th><th>URL</th><th>Date</th><th>Crime Location</th><th>Status</th><th>Status Description</th><th>Priority</th><th>Bureau Notes</th>
		</tr>";
        while($row = $result->fetch_assoc()) 
		{
			$spec=$row['category'];
			$statusdesc=$row['status'];
			$sql2 = "SELECT * FROM specializations WHERE specialization = '$spec'";
			$sql3 = "SELECT * FROM status WHERE status = '$statusdesc'";
			$result2=$conn->query($sql2);
			$row2=$result2->fetch_assoc();
			$result3=$conn->query($sql3);
			$row3=$result3->fetch_assoc();
            $statusresult .= "<tr><td>" . $row['c_id'] . "</td><td>" . $row['category'] . "</td><td>" . $row2["s_desc"]."</td><td>" . $row2["s_location"] . "</td><td>" . $row['subject'] . "</td><td>" . $row['details'] . "</td><td>". $row['url'] . "</td><td>" . $row['datetime'] . "</td><td>". $row['area'] . "</td><td>" . $row['status'] . "</td><td>" . $row3["description"] . "</td><td>" . $row['priority'] . "</td><td>" . $row['bureau_notes'] . "</td></tr>";
        }
		$statusresult .= "</table>";
    } else {
        $errorMsg = "No record for the given complaint ID found. <br>Please try again with a valid complaint ID!!!";
    }
	$conn->close();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cyber Crime Records Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9; /* Optional: Set a light background color */
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 100px auto; /* Center the form vertically */
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #202124;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #202124;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"], 
        input[type="button"] {
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            opacity: 0.9;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        .success {
            color: green;
            font-size: 14px;
        }
        #statusresult {
            margin-top: 20px;
            text-align: left;
            float: left; /* Align the table to the left */
            width: 100%; /* Ensure the table occupies the full width */
        }
        table {
            float: left; /* Float the table explicitly to the left */
            width: 100%; /* Ensure table takes full width */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Complaint Status</h3>
        <form method="post" action="#">
            <label>Enter Complaint ID:</label>
            <input type="text" name="status" placeholder="Format of ID: CXXX">
            <span class="error"><?php echo $statusErr;?></span>
            <input type="submit" name="submit" value="Submit">
            <input type="button" value="Back" onclick="location.href='userwelcome.php?q=<?php echo $login_user; ?>';">
            <br><span class="success"><?php echo $successMsg;?></span>
            <span class="error"><?php echo $errorMsg;?></span>
        </form>
    </div>
    
    <div id="statusresult"><?php echo $statusresult;?></div> <!-- Move the table outside the centered container -->
</body>
</html>
