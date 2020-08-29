<?php 

    session_start();

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/reviews/getAll.php";

    $carsByUser = getCarsForInsertReview();

?>


    <div class="container-fluid forma">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h2>Post a review</h2>

                <div class="row">
                    <div class="col-md-12">

                        <form action="" class="form-horizontal" method="POST" id="reviewForm" >

                            <div class="card">
                                <div class="card-header">Reviews info</div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php if(count($carsByUser)): ?>
                                                    <label for="car">Select vehicle</label>

                                                    <select class="form-control" name="vehicleName" id="vehicleName">
                                                        <option value="0">Select</option>

                                                            <?php foreach($carsByUser as $carUser): ?>
                                                                <option value="<?= $carUser['vehicleId'] ?>"><?= $carUser['brandName'] . " " . $carUser['name'] ?></option>
                                                            <?php endforeach; ?>

                                                        
                                                    </select>
                                                <?php else: ?>
                                                    <p>You must first rent car to be able to write reivew</p>
                                                <?php endif; ?>
                                            
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="reviewTxt">Review text</label>
                                                <textarea class="form-control" name="reviewTxt"  id="reviewTxt" rows="3"></textarea>
                                                <small id="reviewTxtErr" class='form-text text-danger error-field'>Review must have at least 10 chars</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-primary my-3" type="button" id="btnInsertReview" name="btnInsertReview">Submit</button>

                        </form>



                    </div>
                </div>
            
            </div>
        </div>
    </div>
