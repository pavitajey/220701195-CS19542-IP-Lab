<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define variables and set them to empty values
$usernameErr = "";
$username = "";

// Process form data when POST method is used
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty($_POST["username"])) {
        $usernameErr = "Please enter username/password";
    } else {
        $username = test_input($_POST["username"]);
    }

    // Check if password is empty
    if (empty($_POST["password"])) {
        $usernameErr = "Please enter username/password";
    }

    // Proceed if both username and password are provided
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $servername = "localhost";
        $usernamed = "root";
        $password = "";
        $dbname = "cybercrimedatabase";

        // Create connection to the database
        $conn = new mysqli($servername, $usernamed, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $uname = $_POST["username"];
        $pass = $_POST["password"];

        // Prepare the SQL query to fetch user details from the police table
        $sql = "SELECT * FROM police WHERE police_id='$uname'";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            die("Query failed: " . $conn->error);
        }

        // Fetch the row if it exists
        $row = $result->fetch_assoc();

        // Check if a user was found and validate the password
        if ($row && $row["password"] == $pass) {
            session_start();  // Start the session if it's not already started
            $_SESSION['user_name'] = $uname;
            header("Location: policewelcome.php?q=$uname");  // Redirect to the welcome page
            exit();
        } else {
            $usernameErr = "Incorrect credentials! Please enter again.";
        }

        // Close the connection
        $conn->close();
    }
}

// Function to sanitize user input
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
    <meta charset="UTF-8" />
    <title>Cyber Crime Records Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <style>
        body {
            background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/a-computer-desktop-wallpaper-for-forex-trading-terminal-ai-generative-desktop-background-free-photo.jpg'); /* Replace with your new image URL */
            background-size: cover; /* Cover the entire body */
            background-position: center; /* Center the background */
            color: white;
            font-family: Arial, sans-serif;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background-color: rgba(0, 0, 0, 0.5); /* Slightly darker background for contrast */
        }

        .container {
            position: relative;
            z-index: 1;
            text-align: center;
            margin-top: 100px;
        }

        .login {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: auto;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .login label {
            display: block;
            margin-bottom: 10px;
        }

        .login input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
        }

        .login-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

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
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <div class="container">
        <h1>Cyber Crime Records Management System</h1>
        <div class="login">
            <form method="POST" action="">
                <label>
                    <div class="fas fa-user"></div>
                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" />
                </label>
                <label>
                    <div class="fas fa-lock"></div>
                    <input type="password" name="password" placeholder="Password" />
                </label>
                <button type="submit" class="login-button">Sign In</button>
            </form>
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="footer">
            <p>
                New Bureau Member? <a href="policereg.php">Register here!</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false
                },
                "size": {
                    "value": 3,
                    "random": true
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
