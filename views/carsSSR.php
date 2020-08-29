<?php

  require "models/initLoad.php";

  $limit = 2;
  $offset = 0;

  if(isset($_GET['pageNo'])) {
    $offset = ($_GET['pageNo'] - 1) * $limit;
  }

  $upitBrPoslova = "SELECT count(*) as total FROM vehicles";
  $pripremiBr = $db->prepare($upitBrPoslova);
  $pripremiBr->execute();
  $brojPoslova = $pripremiBr->fetch();

  $total = $brojPoslova[0];

  $brStrana = ceil($total / $limit);

  $queryStr = "";

  if(isset($_GET['btnFilter'])) {

    $upit = "SELECT v.*, b.brandName, CONCAT(b.brandName, ' ', v.name) as vehicleName, t.transmissionType, f.fuelType, p.pricePerDay as latestPrice FROM vehicles v INNER JOIN brands b ON v.brandId = b.brandID INNER JOIN transmissions t ON v.transmissionId = t.transmissionId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN prices p ON v.vehicleId = p.vehicleId WHERE 1";

    if(isset($_GET['searchKey']) && $_GET['searchKey'] != "") {
      $key = addslashes(strtolower(($_GET['searchKey'])));
      $upit .= " AND LOWER(CONCAT(b.brandName, ' ', v.name)) LIKE '%$key%'";
      $queryStr .= "&searchKey=$key";
    }

    if(isset($_GET['category']) && $_GET['category'] != "0") {
      $cat = $_GET['category'];
      $upit .= " AND v.categoryId = $cat";
      $queryStr .= "&category=$cat";  
    } else {
      $queryStr .= "&category=0";
    }

    if(isset($_GET['fuel']) && $_GET['fuel'] != "0") {
      $fuelId = $_GET['fuel'];
      $upit .= " AND v.fuelId = $fuelId";
      $queryStr .= "&fuel=$fuelId";  
    } else {
      $queryStr .= "&fuel=0";
    }

    if(isset($_GET['transmission']) && $_GET['transmission'] != "0") {
      $transId = $_GET['transmission'];
      $upit .= " AND v.transmissionId = $transId";
      $queryStr .= "&transmission=$transId";  
    } else {
      $queryStr .= "&transmission=0";
    }

    if(isset($_GET['minVal']) && $_GET['minVal'] != "") {
      $minVal = $_GET['minVal'];
      $upit .= " AND pricePerDay >= $minVal";
      $queryStr .= "&minVal=$minVal";  
    } else {
      $queryStr .= "&minVal=0";
    }

    if(isset($_GET['maxVal']) && $_GET['maxVal'] != "") {
      $maxVal = $_GET['maxVal'];
      $upit .= " AND pricePerDay <= $maxVal";
      $queryStr .= "&maxVal=$maxVal";  
    } else {
      $queryStr .= "&maxVal=0";
    }

    $upitSvi = $upit;

    $pripremiSve = $db->prepare($upitSvi);
    $pripremiSve->execute();

    $rezSvi = $pripremiSve->fetchAll();

    $total = count($rezSvi);

    $brStrana = ceil($total / $limit);

    $upit .= " LIMIT $limit OFFSET $offset";

    // echo $upit;

    $pripremi = $db->prepare($upit);

    $pripremi->execute();

    $cars = $pripremi->fetchAll();


  } else {

    $upit = "SELECT v.*, b.brandName, CONCAT(b.brandName, ' ', v.name) as vehicleName, t.transmissionType, f.fuelType, p.pricePerDay as latestPrice FROM vehicles v INNER JOIN brands b ON v.brandId = b.brandID INNER JOIN transmissions t ON v.transmissionId = t.transmissionId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN prices p ON v.vehicleId = p.vehicleId WHERE 1 LIMIT $limit OFFSET $offset";

    $pripremi = $db->prepare($upit);

    $pripremi->execute();

    $cars = $pripremi->fetchAll();
  }

  $queryStr .= "&btnFilter=Submit";
  $GLOBALS['queryStr'] = $queryStr;

  echo "<p>$upit</p>";
  // echo "<p>$upitSvi</p>";

?>


    <div class="site-section bg-light">
      <div class="container">
        <div class="row">

          <div class="col-md-3 bg-white">
            <h3>Filter</h3>            
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="filterForma mt-4">
  
              <input type="text" id="searchKey" name="searchKey" class="form-control" placeholder="Search" />
  
              <select id="category" name="category" class="form-control">
                <option value="0">Select category</option>

                <?php
                  popuniListe($rez["cats"], "categoryId", "categoryName");
                ?>
              </select>
              
              <select name="fuel" id="fuel" class="form-control">
                <option value="0">Select Fuel</option>

                <?php
                  popuniListe($rez['fuels'], "fuelId", "fuelType");
                ?>
              </select>

              <input type="hidden" id="minVal" name="minVal" value="" />

              <input type="hidden" id="maxVal" name="maxVal" value="" />

              <div>
                <label for="amount">Price range:</label>
                <input type="text" id="amount" readonly />
              </div>
              
              <div id="slider-range"></div>
              

              <input type="button" name="btnFilter" id="btnFilter" class="btn btn-primary" value="Submit" />
            </form>
          </div>

          <div class="col-md-9">
            <h3>Car listing</h3>
            <div class="row mt-4">
            
              <?php 
                // $upit = "SELECT v.*, b.brandName, t.transmissionType, f.fuelType FROM vehicles v INNER JOIN brands b ON v.brandId = b.brandID INNER JOIN transmissions t ON v.transmissionId = t.transmissionId INNER JOIN fuels f ON v.fuelId = f.fuelId";

                // $cars = $db->query($upit)->fetchAll();
            
                foreach($cars as $car):?>

                <div class="col-sm-12 col-md-6 mb-4">
                  <div class="item-1">
                      <a href="#"><img src="slike/<?= $car['mainImg']?>" alt="Image" class="img-fluid"></a>
                      <div class="item-1-contents">
                        <div class="text-center">
                        <h3><a href="#"><?= $car['brandName'] . " " . $car['name'] ?></a></h3>
                        <div class="rating">
                          <span class="icon-star text-warning"></span>
                          <span class="icon-star text-warning"></span>
                          <span class="icon-star text-warning"></span>
                          <span class="icon-star text-warning"></span>
                          <span class="icon-star text-warning"></span>
                        </div>
                        <div class="rent-price"><span>$<?= $car['latestPrice']?>/</span>day</div>
                        </div>
                        <ul class="specs">
                          <li>
                            <span>Doors</span>
                            <span class="spec"><?= $car['doors'] ?></span>
                          </li>
                          <li>
                            <span>Seats</span>
                            <span class="spec"><?= $car['seats'] ?></span>
                          </li>
                          <li>
                            <span>Transmission</span>
                            <span class="spec"><?= $car['transmissionType'] ?></span>
                          </li>
                          <li>
                            <span>Fuel</span>
                            <span class="spec"><?= $car['fuelType'] ?></span>
                          </li>
                        </ul>
                        <div class="d-flex action">
                          <a href="index.php?page=carDetails&carId=<?= $car["vehicleId"]?>" class="btn btn-primary">View Details</a>
                        </div>
                      </div>
                    </div>
                </div>

                <?php endforeach; ?>

              <div class="col-12">
                <!-- <span class="p-3">1</span>
                <a href="#" class="p-3">2</a>
                <a href="#" class="p-3">3</a>
                <a href="#" class="p-3">4</a> -->
                
                <?="<p>$queryStr</p>"; ?>

                <?php for($i = 0; $i < $brStrana; $i++): ?>
                  <a class="p-2" href="<?= $_SERVER['PHP_SELF'] . "?page=cars&pageNo=" . ($i + 1) . $GLOBALS['queryStr']?>"><?= $i + 1?></a>
                <?php endfor; ?>
              </div>

              
            </div>
          </div>


          <!-- <div class="col-12">
            <span class="p-3">1</span>
            <a href="#" class="p-3">2</a>
            <a href="#" class="p-3">3</a>
            <a href="#" class="p-3">4</a>
          </div> -->
        </div>
      </div>
    </div>

    <div class="container site-section mb-5">
      <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>How it works</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
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
          <span class="caption">Checkout</span>
        </div>
        <div class="step">
          <span class="number"><span>05</span></span>
          <span class="caption">Done</span>
        </div>

      </div>
    </div>
