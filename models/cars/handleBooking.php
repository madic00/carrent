<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";

    if($_POST['btnRentRequest']) {
        $carId = $_POST['carId'];
        $userId = $_POST['userId'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];

        $upitCheck = "SELECT * FROM booking WHERE vehicleId = ? AND userId = ? AND status = 0"; //proveriti status dal mu je odobreno rentanje

        $stmtCheck = $db->prepare($upitCheck);

        $stmtCheck->execute([$carId, $userId]);

        $rez = $stmtCheck->fetchAll();

        $odg = "Datumi su u redu";

        $statusOdg = true;

        foreach ($rez as $key => $single) {
            if($fromDate <= $single['toDate']) {
                $statusOdg = false;
                $odg = "You already submited request to this car";
                break;
            } 
        }
        

        // if($fromDate <= $rez[0]['toDate']) {
        //     $odg = "Vec ste rentali auto";
        // } else {
        //     $odg = "Datumi su u redu";
        // }

        if($statusOdg) {
            $upit = "INSERT INTO booking VALUES (NULL, :userId, :vehicleId, :fromDate, :toDate, :status, :currentDate)";
    
            $stmt = $db->prepare($upit);
    
            $status = 0;
    
            $datum = date("Y-m-d H:i:s");
    
            try {
                $rezRequest = $stmt->execute(["userId" => $userId, "vehicleId" => $carId, "fromDate" => $fromDate, "toDate" => $toDate, "status" => $status, "currentDate" => $datum]);
                
            } catch(PDOException $ex) {
                $odg = $ex->getMessage();
            }

            $odg = "You successfully requested. Wait for admin's approval";

        }
        
    } else {
        $statusOdg = false;
        $odg = "Ulazi u else ";
        http_response_code(400);
    }

    echo json_encode(['statusOdg' => $statusOdg, 'odg' => $odg]);

?>