<?php

  require "models/initLoad.php";

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
                    $kategorije = $rez['cats'];

                    foreach ($kategorije as $key => $kat): ?>
                      <option value="<?= $kat['categoryId'] ?>"><?= $kat['categoryName'] ?></option>
                <?php endforeach; ?>

              </select>
              
              <select name="fuel" id="fuel" class="form-control">
                <option value="0">Select Fuel</option>

                <?php
                    $fuels = $rez['fuels'];

                    foreach ($fuels as $key => $fuel): ?>
                      <option value="<?= $fuel['fuelId'] ?>"><?= $fuel['fuelType'] ?></option>
                <?php endforeach; ?>

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
            <div class="row mt-4" id="carsContainer"></div>

              <div id="pagination">
                <!-- <span class="p-3">1</span>
                <a href="#" class="p-3">2</a>
                <a href="#" class="p-3">3</a>
                <a href="#" class="p-3">4</a> -->
                
              </div>

              
          </div>

        </div>
      </div>
    </div>

<?php 
  require "models/cars/filterFromIndex.php";
?>