<?php 

    function izvrsiSelect($upit) {
        global $db;
        $pripremi = $db->prepare($upit);
        $pripremi->execute();

        return $pripremi->fetchAll();
    }

    // ne moze jer mora drugaciji exception da se baca za razlicite op
    function izvrsiInsert($upit, $data) {
        global $db;
        $stmt = $db->prepare($upit);

        $rez = "";

        try {
            $rez = $stmt->execute($data);

        } catch(PDOException $ex) {
            $rez = $ex->getMessage();
        }
        
        return $rez;
    }

    function popuniListe($data, $idProp, $valueProp) {
        $out = "";

        for ($i = 0; $i < count($data); $i++) { 
            $out .= "<option value='" . $data[$i][$idProp] . "'>" . $data[$i][$valueProp] . "</option>";

            // $out .= "<option value=$data[$i][$idProp]>$data[$i][$valueProp]</option>"; zasto se ovde greska javlja

        }

        return $out;
    }


    // STAMPANJE

    function stampajListu($data, $idProp, $valueProp, $text) {
        $out = "
            <div class='form-group'>
                <label for='seats'>$text</label>
                <select class='form-control' name='$valueProp' id='$valueProp'>
                    <option value='0'>Select </option>
        ";

        $out .= popuniListe($data, $idProp, $valueProp);

        $out .= "
                </select>
            </div>
        ";

        echo $out;
    }

    function stampajInput($idAttr, $text, $inputType) {
        $out = "
            <div class='form-group'>
                <label for='seats'>$text</label>
                <input type='" . $inputType . "' class='form-control' name='$idAttr' id='$idAttr' />
                <small id='" . $idAttr . "Err' class='form-text text-danger error-field'>Valid format: </small>
            </div>
        ";

        echo $out;
    }

    function stampajChbs($data, $idProp, $valueProp, $text) {
        $out = "
            <div class='form-group'>
                <p>$text</p>
        ";

        $nameAttr = explode(" " , $text)[1];

        for ($i = 0; $i < count($data); $i++) { 
            
            $out .= "
                <div class='custom-control custom-radio'>
                    <input type='radio' class='custom-control-input' id='customRadio$i' name='" . str_replace(" ", "", $text) . "' value='" .$data[$i][$idProp] . "' />
                    <label class='custom-control-label' for='customRadio$i'>" . $data[$i][$valueProp] . "</label>
                    
                </div>
            ";
        }

        $out .= "
                <small id='" . str_replace(" ", "", $text) . "Err' class='form-text text-danger error-field'>Select one option</small>
            </div>
        ";

        echo $out;
    }

    function stampajOpremu($opremaIzBaze = NULL) {

        $oprema = [
            [
                "idProp" => "aircondition",
                "text" => "Airconditions"
            ],
            [
                "idProp" => "breakSystem",
                "text" => "AntiLock Breaking System"
            ],
            [
                "idProp" => "leatherSeats",
                "text" => "Leather Seats"
            ],
            [
                "idProp" => "brakeAssist",
                "text" => "Brake Assist"
            ],
            [
                "idProp" => "crashSenson",
                "text" => "Crash Sensor"
            ],
            [
                "idProp" => "onboardPc",
                "text" => "Onboard computer"
            ],
            [
                "idProp" => "gps",
                "text" => "GPS"
            ],
            [
                "idProp" => "locking",
                "text" => "Central Locking"
            ],
            [
                "idProp" => "abs",
                "text" => "ABS"
            ],
            [
                "idProp" => "bluetooth",
                "text" => "Bluetooth"
            ],
            [
                "idProp" => "childSeat",
                "text" => "Child Seat"
            ],
            [
                "idProp" => "parkingSensor",
                "text" => "Parking Sensors"
            ]
        ];

        $out = "";

        // var_dump($accessories[1]['idProp'], $accessories[1]['text']);

        for ($i = 0; $i < count($oprema); $i++) {

            if(isset($opremaIzBaze) && $opremaIzBaze[$i]['featureValue'] == 1) {
                $cekirano = "checked='checked'";
            } else {
                $cekirano = "";
            }

            $out .= "
                <div class='col-md-4 my-2'>
                    <div class='form-check form-check-inline'>
                        <input class='oprema form-check-input' type='checkbox' id='" . $oprema[$i]["idProp"] . "' name='" . $oprema[$i]["idProp"] . "' value='1' $cekirano />
                        <label class='form-check-label' for='" . $oprema[$i]["idProp"] . "'> ". $oprema[$i]["text"] . "</label>
                    </div>
    
                </div>
            ";

        }

        echo $out;
    }

    function stampajFajl($idProp, $textProp) {
        $out = "
            <label for='$idProp'>$textProp</label>
            <input type='file' class='form-control' name='$idProp' id='$idProp' />
            <small id='" . $idProp . "Err' class='form-text text-danger error-field'>Attach photo</small>
        ";

        echo $out;
    }


    // PROVERE


    function proveriInput($el) {
        global $greske;

        if(!preg_match($el['regex'], $el['value'])) {
            $greske[] = "Valid format: " + $el['example'];
        }
    }

    function proveriNumber($el) {
        global $greske;

        if($el['type'] == "ddl" || $el['type'] == "number") {
            if(!isset($el['value']) || $el['value'] < 1) {
                $greske[] = $el['error'];
            }
        } else {
            if(!isset($el['value']) || $el['value'] < 10 || $el['value'] > 500) {
                $greske[] = $el['error'];
            }
        }

    }

    function proveriTextarea($el) {
        global $greske;

        if(!isset($el['value']) || strlen($el['value']) < 10) {
            $greske[] = $el['error'];
        }
    }
    
?>