<?php 
    require "models/cars/carDetails.php";

    require "models/functions.php";

?>

<?php if(isset($car['name'])): ?>


    <div class="site-section bg-light">
        <div class="container">
            <div class="text-center">
                <div class="mx-auto">
                    <p class="text-uppercase categoryTitle"><?= $car['categoryName'] ?></p>
                    <h2><?= $car['brandName'] . " \t " . $car['name']?></h2>
                </div>

                <div class="mx-auto mt-5 mb-5 w-75" id="car-gallery">

                    <img src="<?= SLIKE_FOLDER . $car['mainImg']?>" alt="car" class="gallery-highlight img-fluid" />

                    <div class="car-preview">
                        <?php 
                            $srcGlavna = explode(".", $car['mainImg']);
                            $srcGlavna[0] .= "-small";
                            $noviSrc = implode(".", $srcGlavna);
                            
                            $maleSlike = [$car['mainImg'], $slike[0]['imageName'], $slike[1]['imageName']];

                            foreach($maleSlike as $mala):
                                $noviSrc = explode(".", $mala);
                                $noviSrc[0] .= "-small";
                                $noviSrc = implode(".", $noviSrc); ?>

                                <img src="<?= SLIKE_FOLDER . $noviSrc ?>" alt="<?= $mala ?>" />
                            <?php endforeach ?>

                        <!-- <img src="<3?= SLIKE_FOLDER . $noviSrc?>" alt="" /> -->
                        <!-- <img src="<3?= SLIKE_FOLDER ?>test/small-car3.jpg" alt="" /> -->
                    </div>
                </div>
            </div>

            <!-- <div class="text-center mt-5">
                <p>C H E V R L O T</p>
                <h2>Mercedes Grand Sedan</h2>
            </div> -->

            <div class="row">
            <?php 
            
                $mainFeatures = [
                    ["Mileage", "flaticon-dashboard", $car['mileage']],  ["Transmission", "flaticon-piston", $car['transmissionType']],
                    ["Seats", "flaticon-safety-seat", $car['seats']],
                    ["Luggage", "flaticon-backpack", $car['luggage']],
                    ["Fuel", "flaticon-diesel", $car['fuelType']]
                ];

                for($i = 0; $i < count($mainFeatures); $i++): ?>

                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 features">
                        <div class="media-body py-md-4">
                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="<?= $mainFeatures[$i][1]?>"></span></div>
                                <div class="text mb-2">
                                    <h3 class="heading pl-3">
                                        <?= $mainFeatures[$i][0] ?>
                                        <span class="featureValue"><?= $mainFeatures[$i][2]?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>

            <?php endfor; ?>
            </div>

            <div class="row mx-auto justify-content-center mt-4" id="tabs-container">
                <ul class="d-flex pb-3" id="list-container">
                    <li class="tabs active-tab" data-tabname="desc">Description</li>
                    <li class="tabs" data-tabname="features">Features</li>
                    <li class="tabs" data-tabname="reviews">Reviews</li>
                </ul>
            </div>


            <div class="tab-content mt-5">

                <div class="row">
                    <div class="col-md-12 tab-item" id="desc">
                        <p><?= $car['description'] ?></p>
                    </div>

                    <div class="col-md-12 tab-item" id="features">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="features">
                                    <!-- <li class="check"><span class="flaticon-tick"></span>Airconditions</li>
                                    <li class="check"><span class="flaticon-cancel"></span>Child Seat</li>
                                    <li class="check"><span class="ion-ios-checkmark"></span>GPS</li>
                                    <li class="check"><span class="ion-ios-checkmark"></span>Luggage</li>
                                    <li class="check"><span class="ion-ios-checkmark"></span>Music</li> -->

                                    <?php 

                                        // var_dump($oprema);

                                        $prvih = array_slice($oprema, 0, 4);

                                        // foreach ($prvih as $key => $oprema1) {
                                        //     $flatKlasa = "";

                                        //     if($oprema1['value'] == 1) {
                                        //         $flatKlasa = "flaticon-tick";
                                        //     } else {
                                        //         $flatKlasa = "flaticon-cancel";
                                        //     }

                                        //     echo "<li class='check'><span class='$flatKlasa'></span>" . $oprema1['featureName'] . "</li>";
                                        
                                        // }

                                        ispisiLiOpreme($prvih);
                                    
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="features">
                                    <?php 
                                        $srednji = array_slice($oprema, 4, 4);

                                        ispisiLiOpreme($srednji);
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="features">
                                <?php 
                                        $poslednji = array_slice($oprema, 8);

                                        ispisiLiOpreme($poslednji);
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 tab-item" id="reviews">
                        <?php 

                            if(count($reviews)):
                                foreach($reviews as $review): ?>
                                    <div class="d-flex justify-content-between">
                                        <h3>user <?= $review['firstName'] . " " . $review['lastName'] ?></h3>
                                        <p>"<?= $review['reviewText'] ?>"</p>
                                    </div>

                                    <hr />

                                <?php endforeach; ?>
                            <?php else: ?>
                                <p> No reviews for this car.</p>
                            <?php endif; ?>
                    </div>

                    <div class="my-5">
                        
                        <?php if(isset($_SESSION['user'])): ?>

                            <h2>Submit a request</h2>

                            <form>


                            <div class="d-flex mt-5 mb-2">
                                    <div class="form-group mr-5">
                                        <label for="fromDate">From date</label>
                                        <input type="date" id="fromDate" name="fromDate" />
                                    </div>

                                    <div class="form-group mx-5">
                                        <label for="toDate">To date</label>
                                        <input type="date" id="toDate" name="toDate" />
                                    </div>

                            </div>

                                <div id="dateErr" class="form-text text-danger error-field mb-2">Date From must be lower than date to</div>
                            
                                <input class="btn btn-primary" type="button" name="submitRequest" id="submitRequest" value="Submit" data-userid="<?= $_SESSION['user']['userId'] ?>" data-vehicleid="<?= $car['vehicleId'] ?>" />
                            </form>
                        <?php else: ?>
                            <div class="container">
                                <h2>Log in to submit a request</h2>
                            </div>
                        <?php endif; ?>

                    </div>



                </div>
            </div>

            <div class="row justify-content-center text-center mb-5 section-2-title">
                <div class="col-md-6">
                <span class="sub-heading">choose car</span>
                <h2 class="mb-4">Related Cars</h2>
                
                </div>
            </div>
            

            <div class="row" id="relatedCars">

                <?php if(count($relatedCars)): ?>

                    <?php foreach($relatedCars as $key => $relatedCar): ?>

                    <div class="col-md-4 mb-4">
                        <div class="item-1">
                            <img src="<?= SLIKE_FOLDER . $relatedCar['mainImg'] ?>" alt="Image car" class="img-fluid">
                            <div class="item-1-contents">
                            <div class="text-center">
                            <h3><?= $relatedCar['brandName'] . " \t " . $relatedCar['name']?></h3>
                            <div class="rent-price"><span>$100</span>/day</div>
                            </div>
                            <ul class="specs">
                                <li>
                                <span>Doors</span>
                                <span class="spec"><?= $relatedCar['doors'] ?></span>
                                </li>
                                <li>
                                <span>Seats</span>
                                <span class="spec"><?= $relatedCar['seats'] ?></span>
                                </li>
                                <li>
                                <span>Transmission</span>
                                <span class="spec"><?= $relatedCar['transmissionType'] ?></span>
                                </li>
                                <li>
                                <span>Fuel</span>
                                <span class="spec"><?= $relatedCar['fuelType'] ?></span>
                                </li>
                            </ul>
                            <div class="d-flex action">
                                <a href="index.php?page=carDetails&carId=<?= $relatedCar['vehicleId'] ?>" class="btn btn-primary">View Details</a>
                            </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p>There is no related cars </p>
                <?php endif; ?>

            </div>  
            <!-- KRAJ REDA -->



        </div>
    </div>
<?php else:  ?>
    <h2>Select valid car</h2>
<?php endif; ?>
