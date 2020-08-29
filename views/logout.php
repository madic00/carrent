<?php 

    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['userId'];

        izbrisiKorisnaIzFajla($userId);

        unset($_SESSION['user']);

        header("Location: index.php");
    } else {
        echo "Vec nema usera";

        header("Location: index.php");
    }

    // if(isset($_SESSION['user'])) {
    //     unset($_SESSION['user']);
    //     header("Location: index.php?page=index");
    // } else {
    //     header("Location: index.php?page=login");
    // }

?>