<?php 

  require "models/initLoad.php";

?>
    
    <div class="site-section pt-0 pb-0 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-12">
            
              <form class="trip-form" action="index.php" method="GET">
                <div class="row align-items-center mb-4">
                  <div class="col-md-6">
                    <h3 class="m-0">Begin your trip here</h3>
                  </div>
                  <div class="col-md-6 text-md-right">
                    <span class="text-primary" id="numberCars">32</span> <span>cars in our offer</span></span>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">

                    <input type="hidden" name="page" value="cars" />

                    <input type="text" id="searchKey" name="searchKey" class="form-control" placeholder="Search" />

                  </div>
                  <div class="form-group col-md-4">

                  <select id="category" name="category" class="form-control">
                    <option value="0">Select category</option>
                    <?php
                      $kategorije = $rez['cats'];

                      foreach ($kategorije as $key => $kat): ?>
                        <option value="<?= $kat['categoryId'] ?>"><?= $kat['categoryName'] ?></option>
                      <?php endforeach; ?>
                  </select>

                    <!-- <select name="transmission" id="transmission" class="form-control">
                      <option value="0">Select Transmission</option>
                    </select> -->

                  </div>
                  <div class="form-group col-md-4">

                    <select name="fuel" id="fuel" class="form-control">
                      <option value="0">Select Fuel</option>
                      <?php
                        $fuels = $rez['fuels'];

                        foreach ($fuels as $key => $fuel): ?>
                          <option value="<?= $fuel['fuelId'] ?>"><?= $fuel['fuelType'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    
                  </div>
                
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" name="btnFilterIndex" id="btnFilterIndex" value="Submit" class="btn btn-primary">
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h3>Our Offer</h3>
            <p class="mb-4">Create account, look for perfect car, submit request and wait for admin's approval</p>
            <p>
              <a href="#" class="btn btn-primary custom-prev">Previous</a>
              <span class="mx-2">/</span>
              <a href="#" class="btn btn-primary custom-next">Next</a>
            </p>
          </div>
          <div class="col-lg-9">




            <div class="nonloop-block-13 owl-carousel" id="carItems">

              <?php 

                require "models/cars/getAll.php";

                $allCars = getAllCars();

                foreach ($allCars as $car): ?>

              <div class="item-1">
                <img src="<?= SLIKE_FOLDER . "" . $car['mainImg'] ?>" alt="Image <?= $car['name'] ?>" class="img-fluid">
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><?= $car['brandName'] . " " . $car['name'] ?></h3>

                  <div class="rent-price"><span>$<?= $car['pricePerDay']?>/</span>day</div>
                  </div>
                  <ul class="specs">
                    <li>
                      <span>Transmission</span>
                      <span class="spec"><?= $car['transmissionType']?></span>
                    </li>
                    <li>
                      <span>Fuel</span>
                      <span class="spec"><?= $car['fuelType'] ?></span>
                    </li>
                    <li>
                      <span>Doors</span>
                      <span class="spec"><?= $car['doors'] ?></span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec"><?= $car['seats'] ?></span>
                    </li>
                  </ul>
                  <div class="d-flex action">
                    <a href="index.php?page=carDetails&carId=<?= $car['vehicleId'] ?>" class="btn btn-primary">View more</a>
                  </div>
                </div>
              </div> 

                <?php endforeach; ?>

            </div>
            
          </div>
        </div>
      </div>
    </div>

    <div class="site-section section-3" style="background-image: url('assets/images/call.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <h2 class="text-white">Check our amazing offer</h2>
            <p class="text-white my-3">We have cars for every need. Everyone can find car corresponding to their budget.</p>
            <a class="btn btn-light" href="index.php?page=cars">View more</a>
          </div>
        </div>

      </div>
    </div>


    <div class="container site-section mb-5">
      <div class="row red justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>How it works</h2>
          <p>With these simple steps get you to your dream ride</p>
        </div>
      </div>
      <div class="how-it-works d-flex">
        <div class="step">
          <span class="number"><span>01</span></span>
          <span class="caption">Time &amp; Place</span>
        </div>
        <div class="step">
          <span class="number"><span>02</span></span>
          <span class="caption">Car</span>
        </div>
        <div class="step">
          <span class="number"><span>03</span></span>
          <span class="caption">Details</span>
        </div>
        <div class="step">
          <span class="number"><span>04</span></span>
          <span class="caption">Request</span>
        </div>
        <div class="step">
          <span class="number"><span>05</span></span>
          <span class="caption">Admin aprove</span>
        </div>

      </div>
    </div>
    