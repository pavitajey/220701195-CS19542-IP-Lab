<?php
$login_user = "";
if (isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Crime Records Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh; /* Make sure body covers full height */
            overflow: hidden; /* Hide scrollbars */
            animation: fade 15s infinite; /* Control the duration and infinite loop */
        }

        /* Slideshow Background */
        @keyframes fade {
            0% {
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/gettyimages-173439704-612x612.jpg');
            }
            25% {
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/2023_5$largeimg_2104844530.jpg'); /* Replace with actual image URLs */
            }
            50% {
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/gettyimages-1251993745-612x612.jpg'); /* Replace with actual image URLs */
            }
            75% {
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/gettyimages-1251993361-612x612.jpg'); /* Replace with actual image URLs */
            }
            100% {
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/gettyimages-2118345940-612x612.jpg');
            }
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            z-index: -1; /* Send it to the back */
            opacity: 0.7; /* Optional: make it slightly transparent */
        }

        .header {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent header */
            color: whitesmoke;
            padding: 20px;
            text-align: center;
            animation: fadeIn 1s;
        }

        .header h1 {
            font-size: 40px;
            margin: 0;
            animation: fadeInDown 1.5s ease-in-out;
        }

        .welcome-message {
            text-align: center;
            font-size: 35px;
            margin: 20px 0;
            animation: fadeIn 1s ease-in-out;
        }

        .welcome-message i {
            color: lightcyan;
        }

        .options-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 50px;
            animation: fadeInUp 1s ease-in-out;
        }

        .custom-button {
            display: inline-block;
            padding: 15px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            margin: 20px;
            text-decoration: none;
            position: relative; /* Important for particle effect */
            overflow: hidden; /* Important for particle effect */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Added shadow */
            animation: pulse 1.5s infinite; /* Added pulse effect */
        }

        /* Pulse Effect */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .custom-button:hover {
            background-color: #2980b9;
            transform: scale(1.1); /* Increased scale on hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); /* Increased shadow */
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            pointer-events: none; /* Prevent interference with click events */
            animation: particle-animation 0.6s forwards;
        }

        @keyframes particle-animation {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--x), var(--y)) scale(0);
                opacity: 0; /* Fade out */
            }
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent footer */
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
            animation: fadeIn 1s;
        }

        /* Animation styles */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Profile Card Styles */
        .card {
            width: 300px;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent card */
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            animation: fadeInUp 0.5s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .imgBx {
            height: 150px;
            overflow: hidden;
            transition: transform 0.5s; /* Image scaling */
        }

        .imgBx img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .imgBx:hover img {
            transform: scale(1.1); /* Image hover effect */
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .details h2 {
            margin: 10px 0;
            font-size: 20px;
            color: black;
            transition: color 0.3s; /* Color transition */
        }

        .details h2:hover {
            color: goldenrod; /* Color change on hover */
        }

        .details span {
            font-size: 14px;
            color: gray;
        }

        .data {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .data h3 {
            margin: 0;
            font-size: 16px;
        }

        .actionBtn a {
            text-decoration: none;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .actionBtn a:hover {
            background: #2980b9;
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-message {
                font-size: 30px;
            }

            .custom-button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 30px;
            }

            .welcome-message {
                font-size: 25px;
            }

            .custom-button {
                font-size: 12px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

    <div class="welcome-message">
        <h2>WELCOME <i><?php echo htmlspecialchars($login_user); ?></i></h2>
    </div>

    <!-- Animated Profile Card -->
    <div class="card">
        <div class="imgBx">
            <img src="https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/4T3A3015.JPG" alt="Profile Picture" />
        </div>
        <div class="content">
            <div class="details">
                <h2><?php echo htmlspecialchars($login_user); ?><br /><span></span></h2>
                <div class="actionBtn">
                    <!-- Optional actions can be added here -->
                </div>
            </div>
        </div>
    </div>

    <div class="options-container">
        <a href="userviewupdate.php?q=<?php echo htmlspecialchars($login_user); ?>" class="custom-button" data-tooltip="View and update your details">
            VIEW AND UPDATE MY DETAILS
        </a>

        <a href="newcomplaint.php?q=<?php echo htmlspecialchars($login_user); ?>" class="custom-button" data-tooltip="File a new complaint">
            NEW COMPLAINT
        </a>

        <a href="checkstatus.php?q=<?php echo htmlspecialchars($login_user); ?>" class="custom-button" data-tooltip="Check the status of your complaint">
            COMPLAINT STATUS
        </a>

        <a href="mainpage.html" class="custom-button" data-tooltip="Log out from the system">
            LOGOUT
        </a>
    </div>

    <script>
        const buttons = document.querySelectorAll('.custom-button');

        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create multiple particles
                for (let i = 0; i < 10; i++) {
                    const particle = document.createElement('span');
                    particle.classList.add('particle');
                    document.body.appendChild(particle);

                    // Position particle at the click location
                    const rect = button.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    // Set random movement direction and distance for the particle
                    const angle = Math.random() * 2 * Math.PI; // Random angle
                    const distance = Math.random() * 100; // Random distance
                    const xOffset = Math.cos(angle) * distance;
                    const yOffset = Math.sin(angle) * distance;

                    particle.style.setProperty('--x', `${xOffset}px`);
                    particle.style.setProperty('--y', `${yOffset}px`);
                    particle.style.width = `${Math.random() * 10 + 5}px`; // Random size
                    particle.style.height = particle.style.width; // Make it a circle
                    particle.style.left = `${x}px`;
                    particle.style.top = `${y}px`;

                    // Remove particle after animation
                    particle.addEventListener('animationend', () => {
                        particle.remove();
                    });
                }
            });
        });
    </script>

</body>
</html>
