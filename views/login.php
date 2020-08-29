<!-- <3?php 

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

      $upit = "SELECT userId, email FROM users WHERE email = :email AND password = :pass";

      $stmt = $db->prepare($upit);

      $pass = md5($pass);

      try {
        $rez = $stmt->execute(["email" => $email, "pass" => $pass]);

        $user = $stmt->fetchAll();

        // echo $stmt->rowCount();

        if($stmt->rowCount() == 1) {
          $_SESSION['user'] = $user;

          header("Location: index.php");
        } else {
          $greskaMail = "Wrong combination of email/pass";
        }

      } catch(PDOException $ex) {
        echo $ex->getMessage();
      }

    }

  }

?> -->

<?php 
  require "models/functions.php";
?>

<div class="container-fluid py-5" id="formContainer">

    <?php 

        if(isset($rez) && $rez == "") {
            foreach($greskeL as $g) {
                echo "<p>$g</p>";
            }
        }

        unset($greskeL);

        if(isset($_SESSION['greskaMail'])) {
          echo "<p>{$_SESSION['greskaMail']}</p>";
        }

        unset($_SESSION['greskaMail']);

    ?>

    <form action="models/account/login.php" method="POST" onSubmit="return proveriLogin();">

        <?php 

          stampajInput("email", "Email", "email");

          stampajInput("password", "Password", "password");
        
        ?>
       
        <!-- <input type="email" id="email" name="email" class="form-control" placeholder="Email address" />

        <input type="password" id="password" name="password" class="form-control" placeholder="Password"> -->

        <input type="submit" class="btn btn-primary" name="submitLogin" value="Submit" />
  
    </form>

    <p class="mt-5">
      Don't have account? 
      <a class="text-primary" href="index.php?page=register">Sign Up here</a>
    </p>


</div>
