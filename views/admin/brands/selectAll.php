<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/brands/getAll.php";

?>



    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Manage Brands</h2>

                <div class="card">
                    <div class="card-header">Brand details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $brands = getAllBrands();
                                    foreach($brands as $key => $brand): ?>

                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        
                                        <td>
                                            <?= $brand['brandName'] ?>
                                        </td>

                                        <td>
                                            <a class="editBrand" href="#" data-brandid="<?= $brand['brandId']?>">
                                                <span class="flaticon-edit"></span>
                                            </a>

                                            <!-- &nbsp;&nbsp; -->

                                            <a class="deleteBrand" href="#" data-brandid="<?= $brand['brandId'] ?>">
                                                <span class="flaticon-cancel"></span>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-primary my-3 insertBrand" data-type="insertBrand" >Insert new</button>

            </div>
        </div>
    </div>