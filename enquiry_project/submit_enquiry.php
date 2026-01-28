<?php
// 1. Include database connection (USE RELATIVE PATH)
include 'db.php';

/* ================= CAPTCHA VERIFY ================= */

// PASTE YOUR SECRET KEY HERE
$secretKey = "6Ld8pFcsAAAAANh2J4LfMxpwE5EMKgkD7h8UelFf";

// Check captcha response exists
if (empty($_POST['g-recaptcha-response'])) {
    die("Captcha not checked");
}

$captchaResponse = $_POST['g-recaptcha-response'];

// Verify captcha with Google
$verifyURL = "https://www.google.com/recaptcha/api/siteverify";
$data = [
    'secret'   => $secretKey,
    'response' => $captchaResponse,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    ]
];

$context  = stream_context_create($options);
$result   = file_get_contents($verifyURL, false, $context);
$response = json_decode($result);

if (!$response || !$response->success) {
    die("Captcha verification failed");
}

/* ================= FORM VALIDATION ================= */

$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');

if ($name === '' || $email === '' || $mobile === '') {
    die("All required fields must be filled");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    die("Mobile number must be exactly 10 digits");
}

/* ================= INSERT INTO DATABASE ================= */

$sql = "INSERT INTO enquiries (name, email, mobile) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("SQL prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss", $name, $email, $mobile);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

/* ================= SUCCESS ================= */

echo "Enquiry submitted successfully";
?>
