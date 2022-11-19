<?php

// No number
define('REGEX_NO_NUMBER', "^[a-zA-ZÀ-ÿ '-]+$");

// Mail
define('REGEX_MAIL', "^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$");

// Password
// Caractére spéciaux, number, minuscule, majuscule
define('REGEX_PASSWORD', "(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])");

// Imgpark
// JPEG / JPG / PNG
define('REGEX_JPGPNG', "^.+\.(jpe?g|png)$");

// Url park
// HTTPS
define('REGEX_URL_HTTPS', "^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$");

// Only number 1 - 5
define('REGEX_ONLY_NUMBER_1_5', "^[1-5]$");

// Only number
define('REGEX_ONLY_NUMBER', "^[1-9]$");

// Coordinates
define('REGEX_COORDINATES', '^-?([0-9]{1,2}|1[0-7][0-9]|180)(\.[0-9]{1,20})$');
