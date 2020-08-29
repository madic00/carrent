<?php 

    session_start();

    $userId = $_SESSION['user']['userId'];

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/reviews/getAll.php";

?>

    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>Manage Reviews</h2>

                <div class="card">
                    <div class="card-header">Reviews details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Car name</th>
                                    <th>Review</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php 
                                    $carReviews = getCarsByUser();
                                    foreach($carReviews as $key => $carReview): ?>

                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        
                                        <td>
                                            <?= $carReview['brandName'] . " " . $carReview['name'] ?>
                                        </td>

                                        <td>
                                            <textarea class="form-control" id="review<?= $carReview['reviewId'] ?>" rows="3"><?= $carReview['reviewText'] ?></textarea>

                                        </td>

                                        <td>
                                            <a class="editReview" href="#" data-reviewid="<?= $carReview['reviewId']?>">
                                                <span class="flaticon-edit"></span>
                                            </a>

                                            <!-- &nbsp;&nbsp; -->

                                            <a class="deleleReview" href="#" data-reviewid="<?= $carReview['reviewId'] ?>">
                                                <span class="flaticon-cancel"></span>
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <button class="btn btn-primary my-3 insertReview" data-type="insertReview" >Insert new</button>

            </div>
        </div>
    </div>