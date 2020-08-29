<?php 

    require "../../config/connection.php";
    require "../../models/statsLog.php";

?>



    <div class="container-fluid my-5" id="selectVhs">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Number of online users</h2>
                <p><?= $brojUlogavnihKor ?></p>
                <h2>Stats for last 24 hours</h2>
                <p>Total number: <?= $total ?></p>

                <div class="card">
                    <div class="card-header">Visits </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Number</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                   foreach ($arrFinal as $k => $v): ?>
        

                                    <tr>
                                        <td>
                                            <?= $k . ":" ?>
                                        </td>
                                        
                                        <td>
                                            <?= round($v * 100 / $total, 2) . " %: $v times" ?>
                                        </td>

                                    </tr>

                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>