<?php
// config.php

// App settings

// Database configuration

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "mjenquiry_db");

define("APP_NAME", "MJ Enquiry System");
define("APP_ENV", getenv("APP_ENV") ?: "production");
define("BASE_URL", getenv("BASE_URL") ?: "");

// Error handling
if (APP_ENV === "development") {
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
} else {
    ini_set("display_errors", 0);
    error_reporting(0);
}

// Timezone
date_default_timezone_set("Asia/Kolkata");



<?php
