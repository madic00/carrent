<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";

    if(isset($_GET['carId'])) {
        $carId = $_GET['carId'];
    }

    require "../../../models/cars/getSingle.php";

    $redCar = getSingleCar();

    // var_dump($redCar);

?>


    <div class="container-fluid forma">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h2>Update a vehicle</h2>

                <div class="row">
                    <div class="col-md-12">

                        <form action="models/cars/update.php" class="form-horizontal" method="POST" enctype="multipart/form-data" onSubmit="return proveriFormuCar()">

                            <div class="card">
                                <div class="card-header">Basic info</div>
                                <div class="card-body">

                                    <div class="row">
                                        <input type="hidden" name="carId" id="carId" value="<?= $carId ?>" />

                                        <div class="col-md-6">
                                            <?php 

                                                stampajInput("carName", "Car name", "text");
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php 
                                                stampajListu($brands, "brandId", "brandName", "Select brand");
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="desc">Car desc</label>
                                                <textarea class="form-control" name="desc"  id="desc" rows="3"></textarea>
                                                <small id="descErr" class='form-text text-danger error-field'>Description must have at least 10 chars</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajListu($cats, "categoryId", "categoryName", "Select category");
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php 
                                            stampajListu($fuels, "fuelId", "fuelType", "Select fuel");
                                            ?>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("modelYear", "Model year", "number");
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php 
                                                stampajChbs($transmission, "transmissionId", "transmissionType", "transmission type");
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("seats", "Number of seats", "number");
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("doors", "Number of doors", "number");
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("mileage", "Mileage", "number");
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("luggage", "Luggage", "number");
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("price", "Price per day", "number");
                                            ?>
                                        </div>
                                    </div>

                                    <hr />

                                    <h3>Images</h3>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <!-- <label for='coverPhoto'>Cover photo</label>
                                            <input type='file' class='form-control' name='coverPhoto' id='coverPhoto' />
                                            <small id="coverPhotoErr" class='form-text text-danger error-field'>Attach photo</small> -->

                                            <?php 
                                                stampajFajl("coverPhoto", "Cover photo");

                                                $slikaSrc = explode(".", $redCar['basic']['mainImg']);

                                                $slikaSrc[0] .= "-small";

                                                $noviSrc = implode(".", $slikaSrc);
                                            ?>

                                            <img class="my-3" src="<?= SLIKE_FOLDER . $noviSrc ?>" alt="Car <?= $redCar['basic']['name'] ?>" />

                                        </div>

                                        <div class="col-md-4">
                                            <?php 
                                                stampajFajl("otherPhoto", "Other photo");

                                                $slikaSrc = explode(".", $redCar['slike'][0]['imageName']);

                                                $slikaSrc[0] .= "-small";

                                                $noviSrc = implode(".", $slikaSrc);

                                            ?>

                                            <img class="my-3" src="<?= SLIKE_FOLDER . $noviSrc ?>" alt="Car <?= $redCar['basic']['name'] ?>" />
                                        </div>

                                        <div class="col-md-4">
                                            <?php 
                                                stampajFajl("otherPhoto2", "Other photo");

                                                $slikaSrc = explode(".", $redCar['slike'][1]['imageName']);

                                                $slikaSrc[0] .= "-small";

                                                $noviSrc = implode(".", $slikaSrc);
                                            ?>

                                            <img class="my-3" src="<?= SLIKE_FOLDER . $noviSrc ?>" alt="Car <?= $redCar['basic']['name'] ?>" />
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="card my-5">
                                <div class="card-header">Accessories</div>
                                <div class="card-body">
                                    
                                    <div class="row">
                                    <!-- SVAKI CH TREBA U SVOM COL-MD PARENTU DA BUDE, A ne 3 u jednom -->
                                        <?php 
                                            stampajOpremu($redCar['oprema']);
                                        ?>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-primary my-3" type="button" id="btnUpdateCar" name="btnUpdateCar">Submit</button>

                        </form>

                        <!-- <div class="card">
                            <div class="card-header">Basic info</div>
                            <div class="card-body">

                            </div>

                        </div> -->


                    </div>
                </div>
            
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function() {
            
            $("#carId").val("<?= $redCar['basic']['vehicleId'] ?>");
            $("#carName").val("<?= $redCar['basic']['name'] ?>");
            $("#brandName").val("<?= $redCar['basic']['brandId'] ?>");
            $("#desc").val("<?= $redCar['basic']['description'] ?>");
            $("#categoryName").val("<?= $redCar['basic']['categoryId'] ?>");
            $("#fuelType").val("<?= $redCar['basic']['fuelId'] ?>");
            $("#modelYear").val("<?= $redCar['basic']['modelYear'] ?>");

            let transId = "<?= $redCar['basic']['transmissionId'] ?>";

            let transArr = $(".custom-control-input");

            for (let i = 0; i < transArr.length; i++) {
                const element = transArr[i];

                if(element.value == transId) {
                    element.checked = true;
                    break;
                }
            }

            $("#seats").val("<?= $redCar['basic']['seats'] ?>");
            $("#doors").val("<?= $redCar['basic']['doors'] ?>");
            $("#mileage").val("<?= $redCar['basic']['mileage'] ?>");
            $("#luggage").val("<?= $redCar['basic']['luggage'] ?>");
            $("#price").val("<?= $redCar['basic']['pricePerDay'] ?>");
        })


    </script>