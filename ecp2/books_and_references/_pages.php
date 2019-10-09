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
            "title" => "Books & References",
            "link" => "view.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/books_and_references/books_n_references.css",
            "style2" => $rootDir."",
            "script" => $rootDir."scripts/books_and_references/books_n_refs.js",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        ),
        array(
            "title" => "Add",
            "link" => "add.php",
            "templateStyle" => $rootDir."styles/template.css",
            "style" => $rootDir."styles/books_and_references/books_n_references.css",
            "style2" => "",
            "script" => $rootDir."scripts/books_and_references/books_n_refs.js",
            "loginLink" => $rootDir."accounts/login.php",
            "logoutLink" => $rootDir."accounts/logout.php",
            "registerLink" => $rootDir."accounts/register.php"
        )
    );
?>