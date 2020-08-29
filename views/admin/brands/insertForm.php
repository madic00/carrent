<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";

    $modelStrana = "models/brands/insert.php";
    
    if(isset($_GET['brandId'])) {
        require "../../../models/brands/getSingle.php";

        $brandId = $_GET['brandId'];

        $red = getSingleBrand($brandId);

        var_dump($red);

        $modelStrana = "models/brands/update.php";
    }

    // ako je setovan brand id onda stampaj formu za update, ako nije onda forma za insert 
?>


    <div class="container-fluid forma">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h2>Post a brand</h2>

                <div class="row">
                    <div class="col-md-12">

                        <form action="<?= $modelStrana ?>" class="form-horizontal" method="POST" id="brandForm" >

                            <?php if(isset($_GET['brandId'])): ?>
                                <input type="hidden" id="brandId" name="brandId" value="<?= $_GET['brandId']?>" />
                            <?php endif; ?>

                            <div class="card">
                                <div class="card-header">Brand info</div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php 
                                                stampajInput("brandName", "Brand name", "text");
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-primary my-3" type="button" id="btnInsert" name="btnInsert">Submit</button>

                        </form>

                        <!-- <div class="card">
                            <div class="card-header">Basic info</div>
                            <div class="card-body">

                            </div>

                        </div> -->


                    </div>
                </div>
            
            </div>
        </div>
    </div>

    <?php  if(isset($red) && is_array($red)): ?>

    <script>
        document.querySelector("#brandName").value = "<?= $red['brandName'] ?>";

    </script>

    <?php endif; ?>