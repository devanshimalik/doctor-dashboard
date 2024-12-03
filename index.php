<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Hospital Management</title>
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
        }

        /* Home Section */
    #home {
        background: url('./image/hospital_bg.jpg') no-repeat center center/cover; /* Background image */
        height: 90vh;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Align content to top and bottom */
        padding: 50px;
        position: relative;
    }


    #home #appointment-btn {
        align-self: flex-end; 
        border-radius: 50px;
    }

    #home #appointment-btn:hover{
        background-color: #004080;
        color: #ffffff;
    }

        /* About Section */
        #about {
            padding: 50px;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }


        #about .image-box {
            width: 1500px;
            height: 400px;
            padding: 30px; /* Increased padding for a larger box */
            border: 2px solid rgba(255, 255, 255, 0.7); /* Slightly thicker semi-transparent border */
            border-radius: 15px; /* Rounded corners for the box */
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Enhanced shadow for emphasis */
            max-width: 100%; /* Ensures responsiveness */
        }
        #about .image-box img {
            display: block; /* Removes inline spacing below the image */
            width: 100%; /* Ensures the image fits inside the container */
            border-radius: 10px; /* Matches the outer border's roundness */
        }


        /* Testimonial Section */
        #login {
            padding: 50px;
            background-color: #dee2e6;
        }

        .carousel-item img {
            border-radius: 50%;
            width: 500px;
            height: 500px;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 10px;
        }

        /* Footer Section */
        footer {
            background: black;
            color: white;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .social-links {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .icon {
            display: block;
            text-align: center;
            text-decoration: none;
            color: white;
        }
        .icon i {
            display: block;
            font-size: 40px;
            margin-bottom: 8px;
        }


        footer a {
            color: white;
            margin-left: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Hospital Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#login">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="./login/login.php">login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" style="height: 100vh; background-image: url('./image/hospital-bg.jpg') no-repeat center center/cover;">
    <div class="container h-100 d-flex flex-column justify-content-center text-center text-white">
        <a href="./login/login.php" id="appointment-btn" class="btn btn-primary btn-lg mt-4" style="position: absolute; right: 40px; bottom: 40px;">
            Book Appointment
        </a>
    </div>
</section>


    <!-- About Section -->
    <section id="about">
        <div class="image-box">
            <img src="./image/about_imagess.jpg" alt="Hospital Image">
        </div>

        <div class="content">
            <h2>About Our Hospital</h2>
            <p>With a dedicated team of skilled healthcare professionals, we strive to provide exceptional medical services in a welcoming and supportive environment. Our state-of-the-art facilities are equipped with the latest diagnostic tools and treatment options, ensuring that every patient receives the highest standard of care. We are committed to the health and well-being of our community, offering personalized treatment plans tailored to meet the unique needs of each individual. Your health is our priority, and we are here to support you on your journey to wellness.</p>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section id="login">
        <div class="container">
            <h2 class="text-center mb-4">What Our Patients Say</h2>
            <div id="carouselTestimonials" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="text-center">
                            <img src="./image/patient1.jpg" alt="Patient 1">
                            <div class="carousel-caption">
                                <p>"The care and attention I received were excellent. The staff and doctors are amazing!"</p>
                                <h5>- Mrs. Robinson</h5>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-center">
                            <img src="./image/patient2.jpg" alt="Patient 1">
                            <div class="carousel-caption">
                                <p>"The staff and doctors are amazing! They helped me and make it easy for me."</p>
                                <h5>- Mrs. Walker</h5>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-center">
                            <img src="./image/doctor1.jpg" alt="Doctor 1">
                            <div class="carousel-caption">
                                <p>"This is a very efficient way of appointments without any resource or time waste."</p>
                                <h5>- Dr. Joe</h5>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-center">
                            <img src="./image/doctor2.jpg" alt="Doctor 1">
                            <div class="carousel-caption">
                                <p>"This helps me in my downs and i am so grateful to be a part of this."</p>
                                <h5>- Dr. Smith</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselTestimonials" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carouselTestimonials" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer id="contact">
        <div>
            <p><strong>Contact Us:</strong></p>
            <p>Phone: +123456789</p>
            <p>Email: info@hospital.com</p>
        </div>
        <div class="social-links">
            <a class="icon" href="https://google.com" target="_blank"><i class="fab fa-google"></i>Google</a>
            <a class="icon" href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
            <a class="icon" href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
            <a class="icon" href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
