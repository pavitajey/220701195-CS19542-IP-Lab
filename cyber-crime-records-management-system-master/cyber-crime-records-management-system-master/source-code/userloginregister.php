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

        // Prepare the SQL query to fetch user details from the user table
        $sql = "SELECT * FROM user WHERE username = '$uname'";
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
            header("Location: userwelcome.php?q=$uname");  // Redirect to the welcome page
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
    <title>Animation Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        /* Basic styles for particles background */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 2; /* Adjusted to be on top of the login form */
            background-color: rgba(0, 0, 0, 0.5); /* Add a semi-transparent background color for contrast */
        }

        .container {
            position: relative;
            z-index: 3; /* Ensure container is above particles */
        }

        /* Your existing CSS here */
        .login {
            position: relative;
            z-index: 4; /* Ensure login form is above particles */
            /* other login form styles */
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <!-- SVG Image Start -->
    <div class="container">
        <div class="ear ear--left"></div>
        <div class="ear ear--right"></div>
        <div class="face">
            <div class="eyes">
                <div class="eye eye--left">
                    <div class="glow"></div>
                </div>
                <div class="eye eye--right">
                    <div class="glow"></div>
                </div>
            </div>
            <div class="nose">
                <svg width="38.161" height="22.03">
                    <path
                        d="M2.017 10.987Q-.563 7.513.157 4.754C.877 1.994 2.976.135 6.164.093 16.4-.04 22.293-.022 32.048.093c3.501.042 5.48 2.081 6.02 4.661q.54 2.579-2.051 6.233-8.612 10.979-16.664 11.043-8.053.063-17.336-11.043z"
                        fill="#243946"
                    ></path>
                </svg>
                <div class="glow"></div>
            </div>
            <div class="mouth">
                <svg class="smile" viewBox="-2 -2 84 23" width="84" height="23">
                    <path
                        d="M0 0c3.76 9.279 9.69 18.98 26.712 19.238 17.022.258 10.72.258 28 0S75.959 9.182 79.987.161"
                        fill="none"
                        stroke-width="3"
                        stroke-linecap="square"
                        stroke-miterlimit="3"
                    ></path>
                </svg>
                <div class="mouth-hole"></div>
                <div class="tongue breath">
                    <div class="tongue-top"></div>
                    <div class="line"></div>
                    <div class="median"></div>
                </div>
            </div>
        </div>
        <div class="tengah">
            <div class="hands">
                <div class="hand hand--left">
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                </div>
                <div class="hand hand--right">
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                    <div class="finger">
                        <div class="bone"></div>
                        <div class="nail"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG Image End -->

        <!-- Form Start -->
        <div class="tengah">
            <div class="login">
                <form method="POST" action="">
                    <label>
                        <div class="fas fa-user"></div>
                        <input
                            class="username"
                            type="text"
                            name="username"
                            autocomplete="on"
                            placeholder="Username"
                            value="<?php echo $username; ?>"
                        />
                    </label>
                    <label>
                        <div class="fas fa-lock"></div>
                        <input
                            class="password"
                            type="password"
                            name="password"
                            autocomplete="off"
                            placeholder="password"
                        />
                        <button type="button" class="password-button">show</button>
                    </label>
                    <button type="submit" class="login-button">sign in</button>
                </form>
                <span class="error"><?php echo $usernameErr; ?></span>
            </div>
        </div>
        <!-- Form End -->

        <!-- Footer Start -->
        <div class="footer">
            <p>
                Don't have account yet?
                <a class="footer-a" href="userreg.php">Sign Up</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->
    <div class="particle-container">
  <!-- This container will hold the particle animation -->
  <div class="particle particle-1"></div>
  <div class="particle particle-2"></div>
  <div class="particle particle-3"></div>
  <div class="particle particle-4"></div>
  <div class="particle particle-5"></div>
  <div class="particle particle-6"></div>
  <div class="particle particle-7"></div>
  <div class="particle particle-8"></div>
  <div class="particle particle-9"></div>
  <div class="particle particle-10"></div>
</div>

        });
    </script>
</body>
</html>
