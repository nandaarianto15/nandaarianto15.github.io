<?php
require "koneksi.php";

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>CleanWave</title>
</head>
<style>
    .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }
</style>
<body>
    <nav id="navbar" class="navbar">
        <div class="logo">
            <a id="logo-trigger"><img id="logo-img" src="assets/img/1.png" alt="CleanWave Logo"></a>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#price">Price</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="hamburger" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    
    <section class="header">
        <div class="header-content">
            <h1>Laundry that makes your life easier</h1>
            <a href="login.php"><button class="order-btn">Order Now</button></a>
        </div>
    </section>

    <section class="about-us" id="about">
        <div class="about-us-container">
            <div class="about-us-img">
                <p class="about-us-title">ABOUT US</p>
                <img src="assets/img/img2.jpg" alt="">
                <div class="experience">
                    <h3>10</h3>
                    <h4>YEARS EXPERIENCE</h4>
                </div>
            </div>
            <div class="about-us-content">
                <p class="sub-title">ABOUT US</p>
                <h2>Company Overview</h2>
                <p>CleanWave was founded with a mission to provide fast, efficient and high-quality laundry solutions. For over 10 years, we have been serving customers with reliable service, keeping your clothes clean, comfortable and clean. With our experience, we understand the importance of quality and customer satisfaction in every service.</p>
                <ul class="about-us-wrap">
                    <li>
                        <h3>Cost Effective</h3>
                        <p>We offer cost-effective laundry services, without sacrificing quality. Our solutions are designed for all groups at competitive prices.</p>
                    </li>
                    <li>
                        <h3>100% Satisfaction</h3>
                        <p>We guarantee full customer satisfaction. Every garment we handle is processed with the highest care and quality to ensure results that meet expectations.</p>
                    </li>
                    <li>
                        <h3>Insured And Bonded</h3>
                        <p>Your clothes are in safe hands. We guarantee the safety and protection of your clothes during the laundry process.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="about-dev">
            <p class="about-us-title">ABOUT DEVELOPER</p>
            <div class="about-dev-img">
                <img src="assets/img/nanda.png" alt="">
            </div>
            <div class="about-dev-content">
                <p class="sub-title">ABOUT DEVELOPER</p>
                <h2>Nanda Arianto</h2>
                <p>Hi everyone! My name is Nanda Arianto</p>
                <p>I’m a man living in Samarinda, East Kalimantan, Indonesia, and my religion is Islam. In my free time, I enjoy gaming, it's one of my favorite hobbies.</p>
                <p>As a kid, I dreamed of becoming a doctor or a pilot because I wanted to help others and explore new opportunities. Being the oldest of four siblings, I take my role seriously and often act as a mentor and support for my younger brothers.</p>
                <p>Whenever I face challenges, I remind myself that “if others can do it, then I can too.” This belief keeps me motivated to push forward. I also believe that “I may be moving slowly, but I’m not going backwards,” which encourages me to stay committed to my goals, no matter how fast I progress.</p>
                <a href="https://nandaarianto.vercel.app/" target="_blank">
                    <button class="btn-dev">Visit Portfolio <i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                </a>
            </div>
        </div>
    </section>

    <section class="service" id="service">
        <div class="service-header">
            <h2>Our Services</h2>
            <p class="sub-title">Clean, Fragrant, Hygienic & Timely Laundry</p>
        </div>
        <div class="carousel-container">
            <div class="carousel-wrapper" id="carouselWrapper">
                <div class="service-box">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Leather Cleaning</h3>
                    <p>Carefully hand-washed for those special garments that require extra attention.</p>
                </div>
                <div class="service-box">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Pickup and Delivery</h3>
                    <p>Quick pickup and delivery services for your laundry needs.</p>
                </div>
                <div class="service-box">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Alterations and Repairs</h3>
                    <p>Repairs and adjustments to ensure perfect fit and comfort.</p>
                </div>
                <div class="service-box">
                    <i class="fas fa-tshirt"></i>
                    <h3>Clothing Wash</h3>
                    <p>Professional laundry service for your daily wear with quick turnaround.</p>
                </div>
                <div class="service-box">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Ironing</h3>
                    <p>We offer ironing services to keep your clothes wrinkle-free and fresh.</p>
                </div>
                <div class="service-box">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Dry Cleaning</h3>
                    <p>Special care for delicate fabrics and tough stains with our dry cleaning services.</p>
                </div>
            </div>
            
            <div class="carousel-nav">
                <button id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
                <button id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <section class="wework">
        <div class="wework-container">
            <div class="wework-content">
                <p class="sub-title">Our Process, Your Convenience</p>
                <h2>How We Work</h2>
                <p>CleanWave always prioritizes quality and comfort in every step of the laundry process. From ordering to delivery, everything is done with great attention to detail. We understand that your clothes are an important part of everyday life, so every cleaning process is carried out to the highest standards of professionalism. With fast pick-up and drop-off services and a team of trained experts, we ensure every garment is treated in the best way.</p>
                <p>Our efficient cleaning method, both for everyday clothing and more sensitive materials. You can calmly hand over your laundry needs to us, because we will return your clothes in clean, fragrant and ready-to-wear condition. We are always committed to meeting customer expectations with timely service and satisfying results.</p>
            </div>
            <div class="wework-step">
                <div class="step">
                    <span>01</span>
                    <div>
                        <h3>Book a Pickup</h3>
                        <p>Choose a pickup schedule that suits your needs</p>
                    </div>
                </div>
                <div class="step">
                    <span>02</span>
                    <div>
                        <h3>We Collect</h3>
                        <p>Our team will come and collect your clothes</p>
                    </div>
                </div>
                <div class="step">
                    <span>03</span>
                    <div>
                        <h3>Expert Processing</h3>
                        <p>Your clothes are processed by experts with attention to detail</p>
                    </div>
                </div>
                <div class="step">
                    <span>04</span>
                    <div>
                        <h3>We Deliver</h3>
                        <p>We deliver your clean, fresh clothes back to your home</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="price" id="price">
        <div class="price-header">
            <p class="sub-title">Pricing</p>
            <h2>Package Price</h2>
        </div>  
        <div class="price-wrap">
            <div class="package">
                <h3>Basic Package</h3>
                <p>$999.99</p>
                <ul>
                    <li>minimum weight 3kg</li>
                    <li>12 hour service completed</li>
                    <li>dry cleaning - folding - ironing</li>
                    <li>includes pickup and delivery fees</li>
                </ul>
            </div>
            <div class="package">
                <h3>Standard Package</h3>
                <p>$999.99</p>
                <ul>
                    <li>minimum weight 3kg</li>
                    <li>12 hour service completed</li>
                    <li>dry cleaning - folding - ironing</li>
                    <li>includes pickup and delivery fees</li>
                </ul>
            </div>
            <div class="package">
                <h3>Premium Package</h3>
                <p>$999.99</p>
                <ul>
                    <li>minimum weight 3kg</li>
                    <li>12 hour service completed</li>
                    <li>dry cleaning - folding - ironing</li>
                    <li>includes pickup and delivery fees</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="faq" id="faq">
        <div class="faq-container">
            <div class="faq-content">
                <p class="sub-title">FAQ</p>
                <h2>Questions From Our Clients</h2>
                <p>Below are some frequently asked questions from our customers, designed to help you better understand CleanWave services. We are always ready to help answer further questions to provide the best service.</p>
                <img src="assets/img/img1.jpg" alt="">
            </div>
            <div class="faq-accordion">
                <h3 class="accordion-header"><i class="fa-solid fa-chevron-down"></i> Where shall I drop-off my clothes?</h3>
                <div class="accordion-content">
                    <p>We offer a pick-up service directly to your location, but you can also visit our outlet for drop-off.</p>
                </div>
                <h3 class="accordion-header"><i class="fa-solid fa-chevron-down"></i> What methods do you use for washing?</h3>
                <div class="accordion-content">
                    <p>We use professional washing methods, including hand washing, dry cleaning and special care for sensitive fabrics.</p>
                </div>
                <h3 class="accordion-header"><i class="fa-solid fa-chevron-down"></i> Are there any recommendations for caring for clothes?</h3>
                <div class="accordion-content">
                    <p>Make sure you follow the care instructions on the clothing label. We also provide consultations regarding the best methods for caring for each type of fabric.</p>
                </div>
                <h3 class="accordion-header"><i class="fa-solid fa-chevron-down"></i> How do you compensate for loss or damage?</h3>
                <div class="accordion-content">
                    <p>We take full responsibility for any loss or damage that occurs during the laundry process and will provide appropriate compensation.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-header">
            <p class="sub-title">Address</p>
            <h2>Contact Us</h2>
        </div>
        <div class="contact-container">
            <div class="wrap-contact">
                <div class="address">
                    <h3>Indonesian Office</h3>
                    <p>Plaza Bank Index, 11th Floor Suite 1106, Jl. M.H. Thamrin No.Kav.57, RT.9/RW.5, Gondangdia, Menteng, Central Jakarta City, Jakarta 10350</p>
                    <p>+62 81234567890</p>
                    <p>+62 81234567890</p>
                    <p>official@cleanwave.com</p>
                </div>
            </div>
            <div class="wrap-form">
                <form action="crud/create/create-contact-function.php" method="post">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="tel" placeholder="Phone" required pattern="[0-9]*" inputmode="numeric">
                    </div>
                    <textarea placeholder="Message" name="message" required></textarea>
                    <button class="btn-contact" type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="content-group">
                    <h4>About CleanWave</h4>
                    <p>CleanWave is a premium laundry service provider that aims to provide a practical and satisfying experience for customers. We are dedicated to keeping your clothes clean and fresh with the latest technology and professional service.</p>                    
                </div>
                <div class="content-group">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><i class="fa-solid fa-chevron-right"></i> Home</li>
                        <li><i class="fa-solid fa-chevron-right"></i> About</li>
                        <li><i class="fa-solid fa-chevron-right"></i> Service</li>
                        <li><i class="fa-solid fa-chevron-right"></i> Price</li>
                        <li><i class="fa-solid fa-chevron-right"></i> FAQ</li>
                        <li><i class="fa-solid fa-chevron-right"></i> Contact</li>
                        <li><i class="fa-solid fa-chevron-right"></i> Order</li>
                    </ul>
                </div>
                <div class="content-group">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><i class="fa-solid fa-chevron-right"></i> +62 8123456789</li>
                        <li><i class="fa-solid fa-chevron-right"></i> official@cleanwave.com</li>
                        <li><i class="fa-solid fa-chevron-right"></i> Indonesian, Jakarta</li>
                    </ul>
                    <div class="sosmed">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-x-twitter"></i>
                        <i class="fa-brands fa-google"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </div>
                <div class="content-group">
                    <h4>Our Location</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.163878672563!2d106.81183237375868!3d-6.192117906527836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f42159a594e7%3A0xbf0ad1fcf3fc3795!2sPT.%20Mitsui%20Leasing%20Capital%20Indonesia!5e0!3m2!1sid!2sid!4v1727254455101!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="footer-bottom">
                <img id="footer-logo" src="assets/img/1.png" alt="">
                <p>2024 © CleanWave. Design by Nanda Arianto</p>
            </div>
        </div>
    </footer>
    

    <div id="sidebar" class="sidebar">
        <a href="#" class="close-btn" onclick="toggleSidebar()">&times;</a>
        <a href="#">Home</a>
        <a href="#about">About</a>
        <a href="#service">Service</a>
        <a href="#price">Price</a>
        <a href="#faq">FAQ</a>
        <a href="#contact">Contact</a>
    </div>
    
    <div id="responseModal" class="modal">
        <div class="modal-content" id="responseMessage">
            <h1>kontol</h1>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
    <script>
        window.onload = function() {
            const status = "<?php echo $status; ?>";
            if (status === 'success') {
                showResponse('Contact message has been successfully sent!');
            } else if (status === 'error') {
                showResponse('Failed to submit the message. Please try again.');
            }
        };

        function showResponse(message) {
            const responseModal = document.getElementById('responseModal');
            const responseMessage = document.getElementById('responseMessage');
            responseMessage.innerHTML = `<h3 style="margin:0">${message}</h3>`;
            responseModal.style.display = 'block';

            // close setelah 3 detik
            setTimeout(() => {
                responseModal.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
