<?php 

    require "models/functions.php";

?>

    <div class="container my-5">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <?php 
                    if(isset($_SESSION['greskeRegister'])) {
                        foreach ($_SESSION['greskeRegister'] as $key => $greska) {
                            echo "<p class='text-danger'>$greska</p>";
                        }

                        unset($_SESSION['greskeRegister']);
                    }
                
                ?>

                <form action="models/account/register.php" method="POST" onSubmit="return proveriRegister();">
                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                stampajInput("fname", "First name", "text");
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                                stampajInput("lname", "Last name", "text");
                            ?>
                        </div>

                    </div>
                    
                    <?php 
                        stampajInput("email", "Email", "email");

                        stampajInput("password", "Password", "password");
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                stampajInput("licenceNo", "Driver licence No", "text");
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                                stampajInput("yearsExp", "Years of Experience", "number");
                            ?>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" name="submitRegister" value="Submit" />

                </form>

            </div>
        </div>
    </div>

    