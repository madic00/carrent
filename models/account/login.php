<?php 

  session_start();

  require "../../config/connection.php";

  if(isset($_POST['submitLogin'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $regexEmail = "/^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/";

    $greskeL = [];

    if(!preg_match($regexEmail, $email)) {
      $greskeL[] = "Email format: johnconnaly@gmail.com";
    }

    if(strlen($pass) < 5) {
      $greskeL[] = "Password must have 5 chars min";
    }

    if(count($greskeL) == 0) {

      $upit = "SELECT userId, firstName, lastName, email, idRole FROM users WHERE email = :email AND password = :pass";

      $stmt = $db->prepare($upit);

      $pass = md5($pass);

      try {
        $rez = $stmt->execute(["email" => $email, "pass" => $pass]);

        $user = $stmt->fetchAll();

        // echo $stmt->rowCount();

        if($stmt->rowCount() == 1) {
          $_SESSION['user'] = $user[0];

          upisiKorisnikaUFajl($user[0]['userId']);

          if($user[0]['idRole'] == 1) {
            header("Location: ../../index.php?page=admin");
          } else {
            header("Location: ../../index.php?page=cars");
          }

          var_dump($user[0]);

          // header("Location: ../../index.php?page=cars");

        } else {
          $greskaMail = "Wrong combination of email/pass";

          $_SESSION['greskaMail'] = $greskaMail;

          header("Location: ../../index.php?page=login#formContainer");

        }

      } catch(PDOException $ex) {
        handleGresku($ex->getMessage());
      }

    }

  }


?>