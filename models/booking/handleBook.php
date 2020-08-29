<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['btnHandleBook'])) {
        $bookId = $_POST['bookId'];

        $status = $_POST['btnHandleBook'];

        $upitIzvuciCarId = "SELECT vehicleId, fromDate FROM booking WHERE bookId = $bookId";

        $stmtCar = $db->prepare($upitIzvuciCarId);

        $stmtCar->execute();

        $carResult = $stmtCar->fetch();

        $carId = $carResult['vehicleId'];

        $bookDatum = $carResult['fromDate'];
        
        $upitSveRezervacijeZaAuto = "SELECT * FROM booking WHERE vehicleId = $carId AND status = 1";

        $stmtRezervacije = $db->prepare($upitSveRezervacijeZaAuto);

        $stmtRezervacije->execute();

        $rezDatumi = $stmtRezervacije->fetchAll();

        $odg = true;

        foreach($rezDatumi as $key => $singleRez) {
            if($bookDatum < $singleRez['toDate']) {
                $odg = false;
                $odgTxt = "Car is already rented";
                break;
            }
        }

        if($odg) {
            $odgTxt = "Moze da se renta";

            $upitUpdate = "UPDATE booking SET status = 1 WHERE bookId = $bookId";

            $stmtUpdate = $db->prepare($upitUpdate);

            try {

                $stmtUpdate->execute();

                $odg = true;
                $odgTxt = "Successfully approved";

            } catch(PDOException $ex) {
                handleGresku($ex->getMessage());

                $odg = false;

                $odgTxt = "Select valid booking item";
            }
        } 
    } else {
        http_response_code(400);

        $odg = false;
        $odgTxt = "SUbmit forme prvo";
    }

    echo json_encode(['odgovor' => $odg, 'odgovorTxt' => $odgTxt]);

?>