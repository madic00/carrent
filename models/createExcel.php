<?php

    require "../config/connection.php";

    $output = '';


    $upit = "SELECT v.name, c.categoryName, br.brandName, v.description FROM vehicles v INNER JOIN categories c on v.categoryId = c.categoryId INNER JOIN brands br ON v.brandId = br.brandId";

    $stmt = $db->query($upit)->fetchAll();
    
    if(count($stmt) > 0){

        $output .= "<table class='excelTable'>
                        <thead>

                            <tr>
                                <td>Vehicle Name</td>
                                <td>Category</td>
                                <td>Description</td>
                            </tr>

                        </thead>

                        <tbody>";

        foreach($stmt as $rez){

            $output .= "<tr>

                <td>" . $rez['brandName'] . " " . $rez['name'] . "</td>
                <td>" . $rez['categoryName'] . "</td>
            
                <td>" . $rez['description'] . "</td>
            </tr>";

        }



        $output .= "</tbody></table>";

    }

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=vehicles.xls");
    echo $output;


?>