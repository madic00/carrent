<?php 

  // $strana = $_SERVER['PHP_SELF'];

  // if(strpos($strana, "index.php")): 
  if(!isset($_GET['page']) || $_GET['page'] == "index"): ?>

  <!-- pozadinska slika ne u inlineu -->


    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay" style="background-image: url('assets/images/hero_1.jpg')">
        <div class="container">
          <div class="row align-items-center">
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
          </div>
        </div>
      </div>
    </div>
    
  <?php else: ?>

    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay innerpage" style="background-image: url('assets/images/hero_2.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1><?= $pageTitle ?></h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>
