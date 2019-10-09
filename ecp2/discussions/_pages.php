<?php
    $pages = array(
        array(
            "title" => "Home",
            "link" => $rootDir."home.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/home.css",
            "style2" => $rootDir."styles/w3.css",
            "script" => "",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        ),
        array(
            "title" => "Threads",
            "link" => "threads.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/discussions/discussions.css",
            "style2" => $rootDir."",
            "script" => $rootDir."scripts/discussions/discussions.js",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        ),
        array(
            "title" => "View Thread",
            "link" => "view.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/discussions/discussions.css",
            "style2" => "",
            "script" => $rootDir."scripts/discussions/discussions.js",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        ),
        array(
            "title" => "New Thread",
            "link" => "new.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/discussions/discussions.css",
            "style2" => "",
            "script" => $rootDir."scripts/discussions/discussions.js",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        )
    );
?>