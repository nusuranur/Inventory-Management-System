<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        header {
            background: rgb(130, 54, 119);
            color: white;
            padding: 1px 0;
        }

        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        .hero {
            position: relative;
            height: 100vh;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right,rgba(255, 120, 24, 0.67),rgba(175, 0, 146, 0.17),rgba(49, 144, 151, 0.61),rgba(251, 0, 255, 0.37), #00dbde);
            background-size: 200% 200%;
            animation: gradientAnimation 5s ease infinite;
            color: #333;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; } }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero .btn {
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .hero .btn:hover {
            background: #0056b3;
        }

        footer {
            background: black;
            color: white;
            padding: 30px 20px;
        }

        footer .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: auto;
        }

        footer .footer-container div {
            flex: 1 1 200px;
            margin: 10px;
        }

        footer h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin: 5px 0;
        }

        footer ul li a {
            color: #bbb;
            text-decoration: none;
        }

        footer ul li a:hover {
            color: white;
            text-decoration: underline;
        }

        footer .social-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        footer .social-icons a {
            color: #bbb;
            text-decoration: none;
            font-size: 1.5rem;
        }

        footer .social-icons a:hover {
            color: white;
        }

        footer p {
            margin-top: 20px;
            font-size: 0.9rem;
            text-align: center;
        }

        footer h2 {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            -webkit-background-clip: text;
            color: transparent;
            text-align: center;
            margin: 10px 0;
        }

        footer p {
            margin-top: 20px;
            font-size: 0.9rem;
            text-align: center;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: auto;
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 900px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>
<body>

<header>
    <nav>
        <div style="display: flex; align-items: center;">
            <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Logo" style="width: 50px; height: 50px; margin-right: 10px;">
            <h2>Inventory Management System</h2>
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Logo" class="hero-logo" style="display: block; margin: 0 auto 10px; max-width: 150px;">
    <h1><i class="fas fa-box"></i> Welcome to Inventory Management System</h1>
    <p><i class="fas fa-arrow-right"></i>Tools Project</p>
    <p>Your one-stop solution for inventory management! Our system provides an intuitive interface for real-time tracking of inventory, allowing users to manage products, track stock movements, generate reports, and handle reordering with ease.</p>
    <a href="login.php" class="btn"><i class="fas fa-rocket"></i> Get Started</a>
</section>

<footer>
    <div class="footer-container">
        <div>
            <h3>About Us</h3>
            <ul>
                <li><a href="#" onclick="openModal('aboutUsModal')">About Inventory Management System</a></li>
                <li><a href="#" onclick="openModal('careersModal')">Careers</a></li>
                <li><a href="#" onclick="openModal('productsModal')">Products</a></li>
                <li><a href="#" onclick="openModal('newsroomModal')">Story Hub/Newsroom</a></li>
            </ul>
        </div>
        <div>
            <h3>Discover</h3>
            <ul>
                <li><a href="#" onclick="openModal('industryModal')">Industry</a></li>
                <li><a href="#" onclick="openModal('successStoriesModal')">Success Stories</a></li>
            </ul>
        </div>
        <div>
            <h3>Support Resources</h3>
            <ul>
                <li><a href="#" onclick="openModal('supportModal')">Support and Downloads</a></li>
                <li><a href="#" onclick="openModal('contactSupportModal')">Contact Support</a></li>
            </ul>
        </div>
        <div>
            <h3>Connect with Us</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <h2>Inventory Management System</h2>
    <center><p>The Software You Need</p></center>
    <p>&copy; Copyright © Inventory Management System by nur. All rights reserved.</p>
</footer>

<div id="aboutUsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('aboutUsModal')">&times;</span>
        <h2>About Inventory Management System</h2>
        <p>The Inventory Management System (IMS) is a powerful software tool designed to streamline and optimize inventory tracking and management for businesses of all sizes. It offers features such as real-time stock tracking, automated order management, product categorization, and customizable reporting, allowing users to efficiently monitor inventory levels, manage orders, and generate insightful analytics. IMS reduces manual errors, minimizes stock discrepancies, and helps businesses save costs by preventing overstocking and stockouts. With user-friendly interfaces, role-based permissions, and mobile support, the system ensures efficient operations, accuracy, and scalability for any growing business.</p>
    </div>
</div>


<div id="careersModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('careersModal')">&times;</span>
        <h2>Careers</h2>
        <p>Careers at the Inventory Management System (IMS) provide exciting opportunities to work with cutting-edge technology and innovative solutions in the field of inventory management. We are always looking for talented individuals who are passionate about software development, customer support, product management, and data analytics. Joining our team means being part of a collaborative environment where creativity, problem-solving, and continuous learning are encouraged. At IMS, we offer a dynamic work culture with opportunities for career growth, skill development, and contributing to the success of businesses across various industries by providing them with advanced tools to streamline their operations.</p>
    </div>
</div>


<div id="productsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('productsModal')">&times;</span>
        <h2>Products</h2>
        <p>Our Inventory Management System (IMS) offers a suite of robust products designed to simplify and optimize the management of inventory across various industries. The system provides tools for real-time stock tracking, order management, inventory forecasting, and reporting. Our product suite includes modules for handling product addition, updating, and categorization, along with features that support barcode scanning and integration with various sales platforms. The IMS helps businesses of all sizes improve operational efficiency, reduce errors, and maintain accurate records, ultimately boosting productivity and profitability. With a user-friendly interface and customizable options, our products are tailored to meet the unique needs of each client.</p>
    </div>
</div>

<div id="newsroomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('newsroomModal')">&times;</span>
        <h2>Story Hub/Newsroom</h2>
        <p>Our Story Hub/Newsroom serves as a central space for sharing the latest updates, insights, and innovations related to the Inventory Management System (IMS). It provides articles, case studies, and news releases about new product features, software upgrades, and industry trends. The Story Hub is designed to keep our users and partners informed about the latest advancements in inventory management, highlighting success stories, best practices, and thought leadership. Whether you're a new user looking for tips or an industry professional seeking inspiration, the Story Hub is your go-to source for staying connected with our community and the evolving world of inventory management.</p>
    </div>
</div>


<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    }
</script>

</body>
</html>

