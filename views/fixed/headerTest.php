    <header>

        <div class="container-fluid py-3">
            <div class="container">
                    
                <div class="row testiranje">
                    <div class="col-4 col-md-2 ">
                        <!-- <img src="assets/images/logo.png" width="100px" /> -->
                        <h1>Carrent</h1>
                    </div>

                    <div class="col-8 col-md-10 headerInfo d-flex">

                        <div class="headerItem d-none d-md-block">
                            <div class="d-flex">
                                <div class="headerIcon mr-4 mt-1">
                                    <span class="flaticon-email"></span>
                                </div>
        
                                <div class="">
                                    <p class="text-uppercase mb-0">Support mail: </p>
            
                                    <a class="d-block" href="mailto:alemadic@gmail.com">alemadic@gmail.com</a>
        
                                </div>
                            </div> 

                        </div>

                        <div class="headerItem d-none d-md-block">
                            <div class="d-flex">
                                <div class="headerIcon mr-4 mt-1">
                                    <span class="flaticon-call"></span>
                                </div>
        
                                <div class="">
                                    <p class="text-uppercase mb-0">Helpline call us: </p>
            
                                    <a class="d-block" href="mailto:alemadic@gmail.com">+239-200-1317</a>
        
                                </div>
                            </div> 

                        </div>

                        <div class="headerItem headerBtn">

                            <?php if(isset($_SESSION['user'])): ?>
                                <button class="btn btn-primary btn-xs">Login / Register</button>
                            <?php else: ?>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Profile
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-dark py-2">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>

                        </ul>


                    </div>
                </nav>
                <!-- <div class="btn btn-light float-right">Profile</div> -->

            </div>

        </div>
        

        <!-- <div class="d-none d-md-block">

            Novi tekst proba
        </div> -->



    </header>


    <div class="container px-3 py-5">
        <div class="row testiranje">
            <div class="col-4 ">
                <h1>CarRent</h1>
            </div>

            <div class="col-8 d-flex justify-content-end">

                <?php  if(!isset($_SESSION['user'])):?>
                    <button class="btn btn-primary btn-xs text-uppercase">Login / register</button>
                <!-- <3?php else: ?>
                    <div class="user">

                    </div> -->
                <?php endif; ?>

                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

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

    <!-- <div class="hero" id="heroHome">
        <div class="overlay">
            <div class="offset-md-7 col-md-5">
                <h2>Find the right car for you</h2>
            </div>
        
        </div>
    </div> -->

 