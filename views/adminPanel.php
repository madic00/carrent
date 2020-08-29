

    <!-- ovde mogu da stavim ako je setovana greska npr brend da iz url adrese izvucem da se radilo sa brendovima -->

    <div class="container py-5">
        <div class="mx-auto w-50">
            
            <?php
                
            ?>
        
            <ul class="d-flex justify-content-center" id="adminItems">
                <li>
                    <a href="#" data-pagename="cars" class="panelItem mr-4 btn btn-light"> Cars</a>
                </li>

                <li>
                    <a href="#" data-pagename="brands" class="panelItem mr-4 btn btn-light"> Brands</a>
                </li>

                <li>
                    <a href="#" data-pagename="stats" class="panelItem mr-4 btn btn-light"> Stats</a>
                </li>

                <li>
                    <a href="#" data-pagename="bookings" class="panelItem mr-4 btn btn-light">Bookings</a>

                </li>

                <li>
                    <a href="#" data-pagename="adminReview" class="panelItem mr-4 btn btn-light">Reviews</a>

                </li>

                <li>
                    <a href="models/createExcel.php" class="btn btn-info">Export excel</a>
                </li>

            </ul>
        </div>  
    </div>

    <?php 
        // require "models/statsLog.php";
    ?>

    <section id="mainContent">
    
    </section>