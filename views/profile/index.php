<?php 

    echo "<h1>NOVI RUTER ZA PROFILE</h1>";

    if(!isset($_GET['userPage'])) {
        // require "";

        echo "<p>na indexu profila smo</p>";
    } else {
        switch ($_GET['userPage']) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }
?>