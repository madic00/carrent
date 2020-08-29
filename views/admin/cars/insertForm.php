<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
?>


    <div class="container-fluid forma">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h2>Post a vehicle</h2>

                <div class="row">
                    <div class="col-md-12">

                        <form action="models/cars/insert.php" class="form-horizontal" method="POST" enctype="multipart/form-data" onSubmit="return proveriFormuCar()">

                            <div class="card">
                                <div class="card-header">Basic info</div>
                                <div class="card-body">

                                    <div class="row">
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
                                            ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php 
                                                stampajFajl("otherPhoto", "Other photo");
                                            ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php 
                                                stampajFajl("otherPhoto2", "Other photo");
                                            ?>
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
                                            stampajOpremu();
                                        ?>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-primary my-3" type="button" id="btnInsertCar" name="btnInsertCar">Submit</button>

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