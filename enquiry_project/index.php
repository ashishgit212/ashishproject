<?php
require_once "config.php";
require_once "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enquiry Form</title>

    <link rel="stylesheet" href="/style.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="form-container">
    <h2>Enquiry Form</h2>

    <form action="submit_enquiry.php" method="POST">

        <label>Name *</label>
        <input type="text" name="name" required>

        <label>Email <span class="required">*</span></label>
        <input type="email"
               name="email"
               required
               pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
               title="Enter a valid email address (example: abc@gmail.com)">

        <label>Mobile *</label>
        <input type="text"
               name="mobile"
               pattern="[0-9]{10}"
               title="Enter 10 digit mobile number"
               required>

        <div class="g-recaptcha" data-sitekey="<?php echo getenv('RECAPTCHA_SITE_KEY'); ?>"></div>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
