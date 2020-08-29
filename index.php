<?php

    session_start();

    ob_start();

    require "config/connection.php";

    if(!isset($_GET['page'])) {
        $page = "index";
    } else {
        switch ($_GET['page']) {
            case 'cars':
                $page = "cars";
            break;
            
            case 'carDetails':
                $page = "carDetails";
            break; 

            case 'services':
                $page = "services";
                break;
            
            case 'about':
                $page = "about";
            break;
            
            case 'contact':
                $page = "contact";
            break;

            case 'blog':
                $page = "blog";
            break;

            case 'login':
                $page = "login";
            break;

            case 'register':
                $page = "register";
            break;
            
            case 'logout':
                $page = "logout";
            break;

            case 'profile':
                if(isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 2) {
                    $page = "profile";
                } else if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) {
                    $page = "adminPanel";
                } else {
                    header("Location: index.php?page=login");
                }
                
            break;

            case "author":
                $page = "author";
            
            break;
            
            case 'admin':

                if(isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) {
                    $page = "adminPanel";
                } else {
                    header("Location: index.php?page=login");
                }

            break;
            
            default: 
                $page = "index";
            break;

        }
    }

    $metaPodaci = handleMetaData($page);

    require "views/fixed/head.php";
    // require "views/fixed/nav.php";
    require "views/fixed/header.php";
    // var_dump($_SESSION['user']);

    require "views/{$page}.php";
    
    require "views/fixed/footer.php";

?>