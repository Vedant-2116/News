<footer>
    <hr class="footer-line">
    <div class="footer-content">
        <div class="left-content">
            <img src="news.png" alt="Company Logo" class="footer-logo">
            <p class="copyright">&copy; <?php echo date("Y"); ?> Your Company Name</p>
        </div>
        <div class="right-content">
            <img src="X.png" alt="X" class="social-icon">
            <img src="insta.png" alt="Instagram" class="social-icon">
            <img src="f.png" alt="Facebook" class="social-icon">
        </div>
    </div>
</footer>

<style>
    /* Add your custom styles here */
    footer {
        background-color: white;
        color: black; /* Set text color to black */
        padding: 5px;
        text-align: center;
    }

    .footer-line {
        border: 1px solid grey;
        margin: 10px 0; /* Add margin above and below the line for spacing */
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-logo {
        width: 80px; /* Set the width of your company logo */
        height: auto; /* Maintain aspect ratio */
        margin-right: 10px; /* Add some space to the right of the company logo */
    }

    .social-icon {
        width: 30px; /* Adjust the width of your social media icons */
        height: 30px; /* Maintain aspect ratio */
        margin: 0 10px;
        text-decoration: none;
    }

    .copyright {
        font-size: 14px;
        margin: 0;
    }
</style>

