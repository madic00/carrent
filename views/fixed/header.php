

  <div class="container-fluid py-3">
        <div class="container">
                
            <div class="row testiranje">
                <div class="col-4 col-md-2 ">
                    <!-- <img src="assets/images/logo.png" width="100px" /> -->
                    <!-- <h1>CarRent</h1> -->
                    <div>
                      <h1>
                        <a href="index.php">CarRent</a>
                      
                      </h1>
                    </div>
                </div>

                <div class="col-8 col-md-10 headerInfo d-flex">

                    <div class="headerItem d-none d-md-block">
                        <div class="d-flex">
                            <div class="headerIcon mr-4 mt-1">
                                <span class="flaticon-email"></span>
                            </div>
    
                            <div class="">
                                <p class="text-uppercase mb-0">Support mail: </p>
        
                                <a class="d-block linkUp" href="mailto:admin@carrent.com">admin@carrent.com</a>
    
                            </div>
                        </div> 

                    </div>

                    <div class="headerItem d-none d-md-block">
                        <div class="d-flex">
                            <div class="headerIcon mr-4 mt-1">
                                <span class="flaticon-address"></span>
                            </div>
    
                            <div class="">
                                <p class="text-uppercase mb-0">OUR address: </p>
        
                                <p class="linkUp d-block">777 Brockton Avenue, MA 2351</p>
    
                            </div>
                        </div> 

                    </div>

                    <div class="headerItem headerBtn">

                        <?php if(!isset($_SESSION['user'])): ?>
                            <a href="index.php?page=login" class="btn btn-primary btn-xs">Login / Register</a>
                        <?php else: ?>
                            <?php
                              
                              $printName = "";

                              if($_SESSION['user']['idRole'] == 2) {
                                $printName = $_SESSION['user']['firstName'] . " "  . $_SESSION['user']['lastName'];
                              } else {
                                $printName = "Admin" . " " . $_SESSION['user']['firstName'];
                              }
                              
                            ?>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                    <?= $printName ?>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="korMeni">
                                    <!-- <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a> -->
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                
                    
                </div>
            </div>
        </div>
    </div>

     <!-- <div class="container-fluid bg-black py-2">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="glavniMeni">
                            

                    </ul>


                </div>
            </nav>

        </div>

      </div> -->

    <?php require "nav.php"; ?>

  <?php if(!isset($_GET['page']) || $_GET['page'] == "index"): 
      $carId = 16;

      require "models/cars/getSingle.php";

      $heroCar = getSingleIndex();

      // var_dump($heroCar);
  ?>
    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay ftcoCoverIndex" id="ftcoCoverIndex" style="background-image: url('assets/images/hero_1.jpg')">
        <div class="container">
        <div class="row align-items-center py-5">
            <div class=" col-md-4">
              <div class="feature-car-rent-box-1">
                <h3><?= $heroCar['name'] ?></h3>
                <ul class="list-unstyled">
                  <li>
                    <span>Doors</span>
                    <span class="spec"><?= $heroCar['doors'] ?></span>
                  </li>
                  <li>
                    <span>Seats</span>
                    <span class="spec"><?= $heroCar['seats'] ?></span>
                  </li>
                  <li>
                    <span>Lugage</span>
                    <span class="spec"><?= $heroCar['luggage'] ?></span>
                  </li>
                  <li>
                    <span>Transmission</span>
                    <span class="spec"><?= $heroCar['transmissionType'] ?></span>
                  </li>
                  <li>
                    <span>Fuel</span>
                    <span class="spec"><?= $heroCar['fuelType'] ?></span>
                  </li>
                </ul>
                <div class="d-flex align-items-center bg-light p-3">
                  <span>$<?= $heroCar['pricePerDay'] ?>/day</span>
                  <a href="index.php?page=carDetails&carId=<?= $carId ?>" class="ml-auto btn btn-primary">View details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  <?php else: ?>

    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay innerpage" style="background-image: url('assets/images/hero_2.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 text-center my-5">
              <h1 id="titleHeader"><?= $metaPodaci['titleForTag'] ?></h1>
              <p><?= $metaPodaci['desc'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>

          <!-- <div class="row align-items-center">
            <div class="col-lg-5">
              <div class="feature-car-rent-box-1">
                <h3>Range Rover S7</h3>
                <ul class="list-unstyled">
                  <li>
                    <span>Doors</span>
                    <span class="spec">4</span>
                  </li>
                  <li>
                    <span>Seats</span>
                    <span class="spec">6</span>
                  </li>
                  <li>
                    <span>Lugage</span>
                    <span class="spec">2 Suitcase/2 Bags</span>
                  </li>
                  <li>
                    <span>Transmission</span>
                    <span class="spec">Automatic</span>
                  </li>
                  <li>
                    <span>Minium age</span>
                    <span class="spec">Automatic</span>
                  </li>
                </ul>
                <div class="d-flex align-items-center bg-light p-3">
                  <span>$150/day</span>
                  <a href="contact.html" class="ml-auto btn btn-primary">Rent Now</a>
                </div>
              </div>
            </div>
          </div> -->

  <?php 
  
    if(isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1): ?>
  <?php endif; ?>
