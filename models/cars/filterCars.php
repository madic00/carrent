<?php

  header("Content-Type: application/json");

  require "../../config/connection.php";
//   require "models/initLoad.php";

  $limit = 6;
  $offset = 0;

  if(isset($_GET['pageNo'])) {
    $offset = ($_GET['pageNo'] - 1) * $limit;
  }

  $upitBrPoslova = "SELECT count(*) as total FROM vehicles";
  $pripremiBr = $db->prepare($upitBrPoslova);
  $pripremiBr->execute();
  $brojPoslova = $pripremiBr->fetch();

  $total = $brojPoslova[0];

  $brStrana = ceil($total / $limit);

  $queryStr = "";

  if(isset($_GET['btnFilter'])) {

    // $upit = "SELECT v.*, b.brandName, CONCAT(b.brandName, ' ', v.name) as vehicleName, t.transmissionType, f.fuelType, p.pricePerDay as latestPrice FROM vehicles v INNER JOIN brands b ON v.brandId = b.brandID INNER JOIN transmissions t ON v.transmissionId = t.transmissionId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN prices p ON v.vehicleId = p.vehicleId WHERE 1";

    $upit = "SELECT v.*, b.brandName, CONCAT(b.brandName, ' ', v.name) as vehicleName, t.transmissionType, f.fuelType, p.pricePerDay as latestPrice FROM ( SELECT priceId, vehicleId, pricePerDay, date FROM prices ORDER BY date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE 1";

    if(isset($_GET['searchKey']) && $_GET['searchKey'] != "") {
      $key = addslashes(strtolower(($_GET['searchKey'])));
      $upit .= " AND LOWER(CONCAT(b.brandName, ' ', v.name)) LIKE '%$key%'";
      $queryStr .= "&searchKey=$key";
    }

    if(isset($_GET['category']) && $_GET['category'] != "0") {
      $cat = $_GET['category'];
      $upit .= " AND v.categoryId = $cat";
      $queryStr .= "&category=$cat";  
    } else {
      $queryStr .= "&category=0";
    }

    if(isset($_GET['fuel']) && $_GET['fuel'] != "0") {
      $fuelId = $_GET['fuel'];
      $upit .= " AND v.fuelId = $fuelId";
      $queryStr .= "&fuel=$fuelId";  
    } else {
      $queryStr .= "&fuel=0";
    }

    if(isset($_GET['transmission']) && $_GET['transmission'] != "0") {
      $transId = $_GET['transmission'];
      $upit .= " AND v.transmissionId = $transId";
      $queryStr .= "&transmission=$transId";  
    } else {
      $queryStr .= "&transmission=0";
    }

    if(isset($_GET['minVal']) && !empty($_GET['minVal'])) {
      $minVal = $_GET['minVal'];
      $upit .= " AND p.pricePerDay >= $minVal";
      $queryStr .= "&minVal=$minVal";  
    } else {
      $queryStr .= "&minVal=0";
    }

    if(isset($_GET['maxVal']) && !empty($_GET['maxVal'])) {
      $maxVal = $_GET['maxVal'];
      $upit .= " AND p.pricePerDay <= $maxVal";
      $queryStr .= "&maxVal=$maxVal";  
    } else {
      $queryStr .= "&maxVal=0";
    }

    $upit .= " AND p.priceId = ( SELECT MAX(priceId) FROM prices where vehicleId = v.vehicleID)";

    $upitSvi = $upit;

    $pripremiSve = $db->prepare($upitSvi);
    $pripremiSve->execute();

    $rezSvi = $pripremiSve->fetchAll();

    $total = count($rezSvi);

    $brStrana = ceil($total / $limit);

    $upit .= " LIMIT $limit OFFSET $offset";

    // echo $upit;

    $pripremi = $db->prepare($upit);

    $pripremi->execute();

    $cars = $pripremi->fetchAll();


  } else {

    $upit = "SELECT v.*, b.brandName, CONCAT(b.brandName, ' ', v.name) as vehicleName, t.transmissionType, f.fuelType, p.pricePerDay as latestPrice FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE 1 GROUP BY p.vehicleId LIMIT $limit OFFSET $offset";

    $pripremi = $db->prepare($upit);

    $pripremi->execute();

    $cars = $pripremi->fetchAll();
  }

  $queryStr .= "&btnFilter=Submit";


//   echo "<p>$upit</p>";
  // echo "<p>$upitSvi</p>";

  $rez = [
    "cars" => $cars,
    "queryStr" => $queryStr,
    "brStrana" => $brStrana,
    "upit" => $upit
  ];

  echo json_encode($rez);

?>