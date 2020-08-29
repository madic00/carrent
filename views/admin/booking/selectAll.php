<?php 

    require "../../../config/connection.php";
    require "../../../models/initLoad.php";
    require "../../../models/booking/getAll.php";

?>

    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>Manage Booking</h2>

                <div class="card">
                    <div class="card-header">Booking details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User name</th>
                                    <th>Car</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $bookings = getAllBooking();
                                    foreach($bookings as $key => $booking): ?>

                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        
                                        <td>
                                            <?= $booking['firstName'] . " " . $booking['lastName'] ?>
                                        </td>

                                        <td>
                                            <?= $booking['brandName'] . " " . $booking['name'] ?>
                                        </td>

                                        <td>
                                            <?php
                                                $datumOd = explode(" ", $booking['fromDate']);
                                                echo $datumOd[0];
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                $datumDo = explode(" ", $booking['toDate']);
                                                echo $datumDo[0];
                                            ?>
                                        </td>

                                        <td>
                                            <?= "$" . $booking['pricePerDay'] ?>
                                        </td>

                                        <td>
                                            <?php 
                                                if($booking['status'] == 1) {
                                                    $status = "Confirmed";
                                                } else if($booking['status'] == 2) {
                                                    $status = "Canceled";
                                                } else {
                                                    $status = "Not proccesed";
                                                }

                                                echo $status;
                                            ?>
                                        </td>

                                        <td>
                                            <a class="confirmBooking" href="#" data-bookingid="<?= $booking['bookId']?>">
                                                Confirm
                                            </a>

                                            <!-- &nbsp;&nbsp; -->
                                            /

                                            <a class="cancelBooking" href="#" data-bookingid="<?= $booking['bookId'] ?>">
                                                Cancel
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- <button class="btn btn-primary my-3 insertBrand" data-type="insertBrand" >Insert new</button> -->

            </div>
        </div>
    </div>