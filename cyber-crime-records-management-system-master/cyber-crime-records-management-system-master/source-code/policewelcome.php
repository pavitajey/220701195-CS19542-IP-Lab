<?php
$login_user = "";
if (isset($_GET['q'])) {
    $login_user = $_GET['q'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cyber Crime Records Management System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <!-- FontAwesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-image: url('https://r2.fivemanage.com/6kxI5nkGTWQUMpOqpHR31/images/494872adcf51b55e610b7d3d13e50fdc.jpg'); /* Replace with your preferred background image */
                height: 100vh;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: white;
                position: relative;
            }

            /* Particle container styles */
            #particles-js {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 0; /* Ensure particles are in the background */
            }

            /* Welcome Police Animation */
            h2 {
                font-size: 40px;
                margin-bottom: 50px;
                color: yellow;
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
                animation: fadeInBounce 2s ease-in-out;
                z-index: 1; /* Ensure content is above particles */
            }

            /* Fade-in and bounce animation */
            @keyframes fadeInBounce {
                0% {
                    opacity: 0;
                    transform: translateY(-30px);
                }
                50% {
                    opacity: 1;
                    transform: translateY(15px);
                }
                100% {
                    transform: translateY(0);
                }
            }

            /* Button Styles */
            .button-container {
                display: flex;
                gap: 40px;
                z-index: 1; /* Ensure content is above particles */
            }

            .link-button {
                width: 150px;
                height: 150px;
                background-color: rgba(255, 255, 255, 0.1);
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                color: #ffcc00; /* Button text color */
                text-transform: uppercase;
                font-weight: bold;
                font-size: 1rem;
                transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
                cursor: pointer;
                position: relative;
            }

            /* Animation on hover */
            .link-button:hover {
                transform: scale(1.1);
                background-color: rgba(255, 255, 255, 0.2);
                box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
                color: #ff9900; /* Change button text color on hover */
            }

            /* Ripple Effect */
            .link-button:before {
                content: "";
                position: absolute;
                width: 150%;
                height: 150%;
                background: rgba(255, 255, 255, 0.2);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0);
                transition: transform 0.5s ease-out;
                border-radius: 50%;
                z-index: 0;
            }

            .link-button:hover:before {
                transform: translate(-50%, -50%) scale(1);
            }

            .link-button a {
                color: inherit;
                text-decoration: none;
                z-index: 1;
                position: relative;
            }

            .link-button:hover a {
                color: inherit; /* Ensure text color matches parent element */
            }

            p {
                margin-top: 15px;
                font-size: 1.2rem;
            }
        </style>
    </head>
    <body>
        <!-- Particle Background -->
        <div id="particles-js"></div>

        <!-- Welcome User -->
        <h2>WELCOME POLICE <i><?php echo htmlspecialchars($login_user); ?></i></h2>

        <div class="button-container">
            <!-- Option 1: View and Update My Details -->
            <div class="link-button">
                <a href="policeviewupdate.php?q=<?php echo htmlspecialchars($login_user); ?>">
                    View & Update My Details
                </a>
            </div>

            <!-- Option 2: View All Open Complaints -->
            <div class="link-button">
                <a href="opencomplaint.php?q=<?php echo htmlspecialchars($login_user); ?>">
                    View All Open Complaints
                </a>
            </div>

            <!-- Option 3: View My Complaints -->
            <div class="link-button">
                <a href="mycomplaints.php?q=<?php echo htmlspecialchars($login_user); ?>">
                    View My Complaints
                </a>
            </div>

            <!-- Option 4: Logout -->
            <div class="link-button">
                <a href="mainpage.html">Logout</a>
            </div>
        </div>

        <!-- Particles.js library -->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

        <!-- Inline Particle Configuration -->
        <script>
            particlesJS('particles-js', {
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
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
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
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
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
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
        </script>
    </body>
</html>
