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
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure nesciunt nemo vel earum maxime neque!</p>
            <p>
              <a href="#" class="btn btn-primary custom-prev">Previous</a>
              <span class="mx-2">/</span>
              <a href="#" class="btn btn-primary custom-next">Next</a>
            </p>
          </div>
          <div class="col-lg-9">




            <div class="nonloop-block-13 owl-carousel" id="carItems">

             
              <!-- <div class="item-1">
                <a href="#"><img src="assets/images/img_1.jpg" alt="Image" class="img-fluid"></a>
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><a href="#">Range Rover S64 Coupe</a></h3>
                  <div class="rating">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                  </div>
                  <div class="rent-price"><span>$250/</span>day</div>
                  </div>
                  <ul class="specs">
                    <li>
                      <span>Doors</span>
                      <span class="spec">4</span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec">5</span>
                    </li>
                    <li>
                      <span>Transmission</span>
                      <span class="spec">Automatic</span>
                    </li>
                    <li>
                      <span>Minium age</span>
                      <span class="spec">18 years</span>
                    </li>
                  </ul>
                  <div class="d-flex action">
                    <a href="contact.html" class="btn btn-primary">Rent Now</a>
                  </div>
                </div>
              </div>

              <div class="item-1">
                <a href="#"><img src="assets/images/img_2.jpg" alt="Image" class="img-fluid"></a>
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><a href="#">Range Rover S64 Coupe</a></h3>
                  <div class="rating">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                  </div>
                  <div class="rent-price"><span>$250/</span>day</div>
                  </div>
                  <ul class="specs">
                    <li>
                      <span>Doors</span>
                      <span class="spec">4</span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec">5</span>
                    </li>
                    <li>
                      <span>Transmission</span>
                      <span class="spec">Automatic</span>
                    </li>
                    <li>
                      <span>Minium age</span>
                      <span class="spec">18 years</span>
                    </li>
                  </ul>
                  <div class="d-flex action">
                    <a href="contact.html" class="btn btn-primary">Rent Now</a>
                  </div>
                </div>
              </div> -->

              <?php 

                $upitCars = "SELECT v.*, t.transmissionType, f.fuelType FROM vehicles v INNER JOIN brands b on v.brandId = b.brandID INNER JOIN transmissions t ON v.transmissionId = t.transmissionId INNER JOIN fuels f ON v.fuelId = f.fuelId LIMIT 6";

                $stmtCars = $db->query($upitCars);

                $rezCars = $stmtCars->fetchAll();

                foreach ($rezCars as $car): ?>

              <div class="item-1">
                <a href="#"><img src="<?= SLIKE_FOLDER . "" . $car['mainImg'] ?>" alt="Image <?= $car['name'] ?>" class="img-fluid"></a>
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><a href="#"><?= $car['name'] ?></a></h3>
                  <div class="rating">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                  </div>
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
                    <a href="carDetails.php?carId=<?= $car['vehicleId'] ?>" class="btn btn-primary">View more</a>
                  </div>
                </div>
              </div> 

                <?php endforeach; ?>

            </div>
            
          </div>
        </div>
      </div>
    </div>

    <div class="site-section section-3" style="background-image: url('assets/images/hero_2.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <h2 class="text-white">Our services</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-car-1"></span>
              </span>
              <div class="service-1-contents">
                <h3>Repair</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-traffic"></span>
              </span>
              <div class="service-1-contents">
                <h3>Car Accessories</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-valet"></span>
              </span>
              <div class="service-1-contents">
                <h3>Own a Car</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container site-section mb-5">
      <div class="row red justify-content-center text-center">
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
    
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-7 text-center mb-5">
            <h2>Customer Testimony</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="assets/images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <span>Mike Fisher</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="assets/images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <span>Jean Stanley</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, deserunt eveniet veniam. Ipsam, nam, voluptatum"</p>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="assets/images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                <span>Katie Rose</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-white">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-7 text-center mb-5">
            <h2>Our Blog</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="post-entry-1 h-100">
              <a href="single.html">
                <img src="assets/images/post_1.jpg" alt="Image"
                 class="img-fluid">
              </a>
              <div class="post-entry-1-contents">
                
                <h2><a href="single.html">The best car rent in the entire planet</a></h2>
                <span class="meta d-inline-block mb-3">July 17, 2019 <span class="mx-2">by</span> <a href="#">Admin</a></span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos soluta, dolore harum molestias consectetur.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="post-entry-1 h-100">
              <a href="single.html">
                <img src="assets/images/img_2.jpg" alt="Image"
                 class="img-fluid">
              </a>
              <div class="post-entry-1-contents">
                
                <h2><a href="single.html">The best car rent in the entire planet</a></h2>
                <span class="meta d-inline-block mb-3">July 17, 2019 <span class="mx-2">by</span> <a href="#">Admin</a></span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos soluta, dolore harum molestias consectetur.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="post-entry-1 h-100">
              <a href="single.html">
                <img src="assets/images/img_3.jpg" alt="Image"
                 class="img-fluid">
              </a>
              <div class="post-entry-1-contents">
                
                <h2><a href="single.html">The best car rent in the entire planet</a></h2>
                <span class="meta d-inline-block mb-3">July 17, 2019 <span class="mx-2">by</span> <a href="#">Admin</a></span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores eos soluta, dolore harum molestias consectetur.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
