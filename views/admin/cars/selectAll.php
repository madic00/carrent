<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/cars/getAll.php";

?>



    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Manage Vehicles</h2>

                <div class="card">
                    <div class="card-header">Vehicle details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Car model</th>
                                    <th>Brand</th>
                                    <th>Price Per hay</th>
                                    <th>Fuel type</th>
                                    <th>Model year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $cars = getAllCars();
                                    foreach($cars as $car): ?>

                                    <tr>
                                        <td>
                                            <?= $car['name'] ?>
                                        </td>
                                        <td>
                                            <?= $car['brandName'] ?>
                                        </td>

                                        <td>
                                            $<?= $car['pricePerDay']; ?>
                                        </td>

                                        <td>
                                            <?= $car['fuelType']?>
                                        </td>

                                        <td>
                                            <?= $car['modelYear'] ?>
                                        </td>

                                        <td>
                                            <a class="editCar" href="#" data-carid="<?= $car['vehicleId']?>">
                                                <span class="flaticon-edit"></span>
                                            </a>

                                            <!-- &nbsp;&nbsp; -->

                                            <a class="deleteCar" href="#" data-carid="<?= $car['vehicleId'] ?>">
                                                <span class="flaticon-cancel"></span>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-primary my-3 insertCar" data-type="insertCar" >Insert new</button>

            </div>
        </div>
    </div>