
<style>
  
    body,
    h1,
    h2,
    h3,
    p,
    ul {
        margin: 0;
        padding: 0;
    }

    .footer {
        /* background-color: #333; */
        /* color: #fff; */
        padding: 20px 0;
    }

    .footer-container {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .footer-logo {
        flex: 1;
        max-width: 200px;
    }

    .footer-logo img {
        width: 100%;
        height: auto;
    }

    .rights {
        font-size: 14px;
        margin-top: 10px;
    }

    .footer-links {
        display: flex;
        flex: 2;
        justify-content: space-around;
    }

    .footer-links-div {
        margin-right: 20px;
    }

    .footer-links h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .footer-links ul {
        list-style-type: none;
        padding: 0;
    }

    .footer-links ul li {
        margin-bottom: 5px;
    }

    .footer-links-div address {
        font-style: normal;
    }

    .footer-copyright {
        text-align: center;
        margin-top: 20px;
    }


    .footer-links_div p:hover {
        color: #7065D4;
    }

    @media screen and (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            align-items: center;
        }

        .footer-logo,
        .footer-links {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
    }
</style>
<div class="footer section-padding">
    <div class="footer-links">
        <div class="footer-links_logo">
            <a href="#"><img src="./images/logo.png" alt="logo" /></a>
            <p>Kathmandu, Nepal, All Rights Reserved</p>
        </div>
        <div class="footer-links_div">
            <h4><a href="./products.php">SHOP</a></h4>
            <p><a href="./products.php">ALL</a></p>
            <p><a href="./products.php">MEN</a></p>
            <p><a href="./products.php">WOMEN</a></p>
            
        </div>

        <div class="footer-links_div">
            <h4>CUSTOMER SERVICE</h4>
            <p><a href="./about.php">About Us</a></p>
            <p><a href="./about.php">Privacy Policies</a> </p>
            <p><a href="./contact.php">Contact</a></p>
        </div>

        <div class="">
            <h4>Get in Touch</h4>
            <p>Kathmandu, Nepal</p>
            <p>+977-9761626067</p>
            <p>FashionNova@gmail.com</p>
        </div>


    </div>
    <div class="footer-copyright">
        <p>&copy;
            FashionNova, an imaginative entity intricately interwoven.</p>
    </div>
</div>