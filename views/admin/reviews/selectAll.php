<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/reviews/getAll.php";

?>

    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>Manage Reviews</h2>

                <div class="card">
                    <div class="card-header">Review details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User name</th>
                                    <th>Car</th>
                                    <th>Review</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $reviews = getReviewsAdmin();

                                    foreach($reviews as $key=> $review):?>

                                    <tr>
                                        <td><?= $key + 1 ?></td>

                                        <td><?= $review['firstName'] . " " . $review['lastName'] ?></td>

                                        <td><?= $review['brandName'] . " " . $review['name'] ?></td>

                                        <td><?= $review['reviewText'] ?></td>

                                        <td>
                                            <?php 
                                                $statusTxt = "";

                                                if($review['reviewStatus'] == 1) {
                                                    $statusTxt = "Visible";
                                                } else {
                                                    $statusTxt = "Hidden";
                                                }

                                                echo $statusTxt;
                                            ?>
                                        </td>

                                        <td>
                                            <a class="changeStatus" href="#" data-reviewid="<?= $review['reviewId']?>" data-reviewstatus="1">
                                                Show
                                            </a>

                                            <!-- &nbsp;&nbsp; -->
                                            /

                                            <a class="changeStatus" href="#" data-reviewid="<?= $review['reviewId'] ?>" data-reviewstatus="0">
                                                Hide
                                            </a>
                                        </td>

                                    </tr>

                                    <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- <button class="btn btn-primary my-3 insertBrand" data-type="insertBrand" >Insert new</button> -->

            </div>
        </div>
    </div>