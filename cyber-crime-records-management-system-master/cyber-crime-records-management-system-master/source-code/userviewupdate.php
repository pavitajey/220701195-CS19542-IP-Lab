<?php
$login_user = "";
if (isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
$addressErr = $pincodeErr = $emailErr = "";
$name = $username = $address = $pincode = $email = $gender = $phone = "";
$successMsg = $errorMsg = "";

// DB Connection
$servername = "localhost";
$usernamed = "root";
$passwords = "";
$dbname = "cybercrimedatabase";

$conn = new mysqli($servername, $usernamed, $passwords, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_user = test_input($login_user);
$sql = "SELECT * from user where username='$login_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$name = $row["name"];
$username = $row["username"];
$address = $row["address"];
$pincode = $row["pincode"];
$email = $row["email"];
$phone = $row["phone"];
$gender = $row["gender"];

$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }
  
    if (empty($_POST["pincode"])) {
        $pincodeErr = "Pincode is required";
    } else {
        $pincode = test_input($_POST["pincode"]);
        // check if pincode only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/", $pincode)) {
            $pincodeErr = "Only numbers allowed"; 
        }
    }
  
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
        }
    }
  
    if (empty($_POST["phone"])) {
        $phone = "";
    } else {
        $phone = test_input($_POST["phone"]);
    }
}

if (!empty($_POST["address"]) && !empty($_POST["pincode"]) && !empty($_POST["email"]) && $emailErr == "" && $pincodeErr == "") {	
    $conn = new mysqli($servername, $usernamed, $passwords, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "UPDATE user SET address = '$address', pincode = '$pincode', email = '$email', phone = '$phone' WHERE username = '$login_user'";
    if ($conn->query($sql) === TRUE) {
        $successMsg = "Update Successful. Click on BACK button.";
    } else {
        $errorMsg = "Update Failed due to some Internal Error!!! Please try again.";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Crime Records Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script> <!-- Include particles.js -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/a-computer-desktop-wallpaper-for-forex-trading-terminal-ai-generative-desktop-background-free-photo.jpg'); /* Prevents scrollbars from showing */
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1; /* Place behind other content */
        }

        .error {
            color: #FF0000;
        }
        .success {
            color: #008000;
        }

        /* Ripple effect */
        .ripple {
            position: relative;
            overflow: hidden;
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .ripple:hover {
            background-color: #2980b9;
        }

        .ripple:after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Input transitions */
        input[type="text"] {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border: 1px solid #3498db;
            outline: none;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            transition: transform 0.3s ease;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        table:hover {
            transform: scale(1.02);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h1, h2 {
            text-align: center;
            color: #ddd;
        }

        /* Footer */
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: gray;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div id="particles-js"></div> <!-- Particle background -->

    <h2>View and Update My Details</h2>
    <div style="margin-top: 10px; background-image: url('cover22.jpg'); background-size: cover; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);"> 
        <form method="post" action="#">
            <table>
                <tr><td>Username:</td><td><?php echo htmlspecialchars($username); ?></td></tr>
                <tr><td>Name:</td><td><?php echo htmlspecialchars($name); ?></td></tr>
                <tr><td>Gender:</td><td><?php echo htmlspecialchars($gender); ?></td></tr>
                <tr><td>Address:</td><td><input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    <span class="error">* <?php echo $addressErr; ?></span></td></tr>
                <tr><td>Pincode:</td><td><input type="text" name="pincode" value="<?php echo htmlspecialchars($pincode); ?>">
                    <span class="error">* <?php echo $pincodeErr; ?></span></td></tr>
                <tr><td>Email ID:</td><td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <span class="error">* <?php echo $emailErr; ?></span></td></tr>
                <tr><td>Phone No:</td><td><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"></td></tr>
                <tr>
                    <td>
                        <button class="ripple" type="submit" name="submit">Update</button>
                    </td>
                    <td>
                        <button class="ripple" type="button" onclick="location.href='userwelcome.php?q=<?php echo htmlspecialchars($login_user); ?>';">Back</button>
                        <br>
                        <span class="success"><?php echo $successMsg; ?></span>
                        <span class="error"><?php echo $errorMsg; ?></span>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        particlesJS.load('particles-js', 'https://cdn.jsdelivr.net/gh/VincentGarreau/particles.js/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
    
</body>
</html>
