<?php 

    session_start();

    require "../../config/connection.php";

    if(isset($_POST['submitRegister'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $licenceNo = $_POST['licenceNo'];
        $yearsExp = $_POST['yearsExp'];

        $regexName = "/^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/";
        $regexEmail = "/^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/";
        $regexLicenceNo = "/^[A-Z][\d]{3}-[\d]{3}-[\d]{2}-[\d]{3}-[\d]$/";

        $greskeR = [];

        if(!preg_match($regexName, $fname)) {
            $greskeR[] = "First Name format: John";
        }

        if(!preg_match($regexName, $lname)) {
            $greskeR[] = "Last name format: Connaly";
        }

        if(!preg_match($regexEmail, $email)) {
            $greskeR[] = "Email format: johnconnaly@gmail.com";
        }

        if(strlen($password) < 5) {
            $greskeR[] = "Password must have 5 chars min";
        }

        if(!preg_match($regexLicenceNo, $licenceNo)) {
            $greskeR[] = "Licence No format: F255-921-50-094-0";
        }

        if($yearsExp == "" || $yearsExp < 0) {
            $greskeR[] = "Years of Experience must be positive number";
        }

        if(count($greskeR) == 0) {

            $upit = "INSERT INTO users VALUES(NULL, :fname, :lname, :email, :pass, :licenceNo, :yearsOfExp, :datum, :idRole)";

            $stmt = $db->prepare($upit);

            $pass = md5($password);

            $datum = date("Y-m-d H:i:s");

            try {
                $rez = $stmt->execute(["fname" => $fname, "lname" => $lname, "email" => $email, "pass" => $pass, "licenceNo" => $licenceNo, "yearsOfExp" => $yearsExp, "datum" => $datum, "idRole" => 2]);

                // header lokacije na login

                header("Location: ../../index.php?page=login");

            } catch(PDOException $ex) {
                handleGresku($ex->getMessage());

                $greskeR[] = "User with this licence number alredy exist";

                $_SESSION['greskeRegister'] = $greskeR;

                header("Location: ../../index.php?page=register");
            }

        } else {
            $_SESSION['greskeRegister'] = $greskeR;

            header("Location: ../../index.php?page=register");
        }


    }


?>