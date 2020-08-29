<?php 

    // function proveriFormuCar() {

    // }

    function premestiSliku($fajl) {

    }


    // function premestiSliku() {

    // }


    function obradiVelicinuSlike($fajl, $novaPutanja) {
        list($sirina, $visina) = getimagesize($novaPutanja);

        $novaSirinaVelika = 720;
        $novaSirinaMala = 200;

        $procenatPromene = $novaSirinaVelika / $sirina;
        $novaVisina = $visina * $procenatPromene;

        $novaSlika = imagecreatetruecolor($novaSirinaVelika, $novaVisina);

        $izvor = "";

        if($fajl['type'] == "image/jpeg") {
            $izvor = imagecreatefromjpeg($novaPutanja);
        } else {
            $izvor = imagecreatefrompng($novaPutanja);
        }

        imagecopyresized($novaSlika, $izvor, 0, 0, 0, 0, $novaSirinaVelika, $novaVisina, $sirina, $visina);

        imagejpeg($novaSlika, $novaPutanja);


        // za malu sliku
        $procenatMala = $novaSirinaMala / $sirina;
        $novaVisinaMala = $visina *  $procenatMala;

        $malaSlika = imagecreatetruecolor($novaSirinaMala, $novaVisinaMala);

        imagecopyresized($malaSlika, $izvor, 0, 0, 0, 0, $novaSirinaMala, $novaVisinaMala, $sirina, $visina);

        $nizIme = explode(".", $novaPutanja);
        $nizIme[0] .= "-small";

        $novoImeSlike = implode(".", $nizIme);
        

        imagejpeg($malaSlika, $novoImeSlike);

    }


?>