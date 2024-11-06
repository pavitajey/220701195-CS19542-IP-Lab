<?php
$login_user="";
if(isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
// define variables and set to empty values
$specErr = $subjectErr = $detailsErr = $urlErr = $socialErr = $dateErr = $areaErr = "";
$spec = $subject = $details = $url = $social = $dates = $area = $suspect = "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if(isset($_POST['specialization']) && $_POST['specialization'] == '0') { 
    $specErr = "Category is required";
  } else {
	 $spec = test_input($_POST["specialization"]);
  }
  
  if (empty($_POST["subject"])) {
    $subjectErr = "Subject is required";
  } else {
    $subject = test_input($_POST["subject"]);
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$subject)) {
      $subjectErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["details"])) {
    $detailsErr = "Details is required";
  } else {
    $details = test_input($_POST["details"]);
  }
  
  if (empty($_POST["url"])) {
    $urlErr = "URL is required";
  } else {
    $url = test_input($_POST["url"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
      $urlErr = "Invalid URL"; 
    }
  }
  
  if (empty($_POST["social"])) {
    $social = "";
  } else {
    $social = test_input($_POST["social"]);
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$social)) {
      $socialErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["area"])) {
    $areaErr = "Area/Place is required";
  } else {
    $area = test_input($_POST["area"]);
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$area)) {
      $areaErr = "Only letters, numbers and white space allowed"; 
    }
  }
  
  if (empty($_POST["dates"])) {
    $dateErr = "Date is required";
  } else {
    $dates = test_input($_POST["dates"]);
  }
  
  if (empty($_POST["suspect"])) {
    $suspect = "";
  } else {
    $suspect = test_input($_POST["suspect"]);
  }

}

if (!empty($_POST["subject"]) && !empty($_POST["details"]) && !empty($_POST["url"]) && !empty($_POST["dates"]) && !empty($_POST["area"]) && isset($_POST['specialization']) && $_POST['specialization'] != '0' && $areaErr == "" && $socialErr == "" && $subjectErr == "" & $urlErr == "")
{
	$servername= "localhost";
    $usernamed = "root";
    $passwords = "";
    $dbname = "cybercrimedatabase";
	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }
    $c_id = generateRandomString();
    $sql = "INSERT INTO complaint (c_id, category, subject, details, url, social_media, datetime, suspect, area, status, priority) VALUES ('$c_id','$spec','$subject','$details','$url','$social','$dates','$suspect','$area','NEW','')";
	
    if ($conn->query($sql) === TRUE) {
    $successMsg = "Complaint submitted successfully. Complaint ID is $c_id (Please take a note of it) <br> Click on BACK button to Check Status.";
    } 
	else {
    $errorMsg = "Some Internal Error Occurred. Please Try Again!!!";
    }
	$conn->close();
}

function generateRandomString($length = 3) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = 'C';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
        <title>Complaint Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
            body {
                font-family: 'Arial', sans-serif;
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/cyber-security-background-h7q4dz7nn9u9cvmt.jpg'); /* Replace with your preferred background image */
                background-color: #f1f3f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                max-width: 700px;
                margin: 50px auto;
                padding: 20px;
                background-color: white;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }
            h1 {
                text-align: center;
                font-size: 28px;
                font-weight: 400;
                color: #202124;
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-top: 20px;
                font-size: 16px;
                color: #202124;
            }
            input[type="text"],
            input[type="date"],
            textarea,
            select {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                border: 1px solid #dadce0;
                border-radius: 4px;
                font-size: 14px;
                box-sizing: border-box;
            }
            textarea {
                height: 100px;
            }
            input[type="submit"], 
            input[type="button"] {
                background-color: #1a73e8;
                color: white;
                border: none;
                padding: 12px 24px;
                margin-top: 20px;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }
            input[type="button"] {
                background-color: #5f6368;
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
            .form-group {
                margin-bottom: 20px;
            }
		</style>
    </head>
    <body>
        <div class="container">
            <h1>New Complaint Form</h1>
            <form method="post" action="#">
                <div class="form-group">
                    <label>Category:</label>
                    <select name="specialization">
                        <option value="0">Please Select</option>
                        <option>Bank Account Fraud</option>
                        <option>Cyberbullying</option>
						<option>Child Pornography</option>
						<option>Identity Theft</option>
						<option>Social Media Content</option>
						<option>Hacking and Viruses</option>
						<option>E-Commerce Scam</option>
						<option>Email or Phone Call Scam</option>
                    </select>
                    <span class="error"><?php echo $specErr;?></span>
                </div>
                
                <div class="form-group">
                    <label>Subject:</label>
                    <input type="text" name="subject" value="<?php echo $subject;?>">
                    <span class="error"><?php echo $subjectErr;?></span>
                </div>

                <div class="form-group">
                    <label>Details:</label>
                    <textarea name="details"><?php echo $details;?></textarea>
                    <span class="error"><?php echo $detailsErr;?></span>
                </div>

                <div class="form-group">
                    <label>Website/URL:</label>
                    <input type="text" name="url" value="<?php echo $url;?>">
                    <span class="error"><?php echo $urlErr;?></span>
                </div>

                <div class="form-group">
                    <label>Social Media:</label>
                    <input type="text" name="social" value="<?php echo $social;?>">
                    <span class="error"><?php echo $socialErr;?></span>
                </div>

                <div class="form-group">
                    <label>Suspect Details:</label>
                    <textarea name="suspect"><?php echo $suspect;?></textarea>
                </div>

                <div class="form-group">
                    <label>Date:</label>
                    <input type="date" name="dates" value="<?php echo $dates;?>">
                    <span class="error"><?php echo $dateErr;?></span>
                </div>

                <div class="form-group">
                    <label>Area:</label>
                    <input type="text" name="area" value="<?php echo $area;?>">
                    <span class="error"><?php echo $areaErr;?></span>
                </div>

                <input type="submit" name="submit" value="Submit">
                <input type="button" value="Back" onclick="location.href='userwelcome.php?q=<?php echo $login_user; ?>';">
                <br><span class="success"><?php echo $successMsg;?></span>
                <span class="error"><?php echo $errorMsg;?></span>
            </form>
        </div>
    </body>
</html>
