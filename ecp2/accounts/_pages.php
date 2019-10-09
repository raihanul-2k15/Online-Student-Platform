<?php
    $pages = array(
        array(
            "title" => "Home",
            "link" => "../home.php",
            "templateStyle" => "",
            "style" => "",
            "style2" => "",
            "script" => "",
            "loginLink" => "",
            "logoutLink" => "",
            "registerLink" => ""
        ),
        array(
            "title" => "Login",
            "link" => "login.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/accounts/login_n_register.css",
            "style2" => "",
            "script" => $rootDir."scripts/accounts/login_n_register_validate.js",
            "loginLink" => "login.php",
            "logoutLink" => "logout.php",
            "registerLink" => "register.php"
        ),
        array(
            "title" => "Register",
            "link" => "register.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/accounts/login_n_register.css",
            "style2" => "",
            "script" => $rootDir."scripts/accounts/login_n_register_validate.js",
            "loginLink" => "login.php",
            "logoutLink" => "logout.php",
            "registerLink" => "register.php"
        )
    );
?>