<?php
    session_start();
    
    $word = new COM("word.application") or die("Unable to instantiate Word");

    $word->Visible=0;

    $word->Documents->Add();

    $txt = "Aleksandar Madic";
    $txt1 = "I am currently a student at the ICT College. I was born in Bor, where I finished elementary and high school. In high school, I first encountered web design and a little bit of programming and I liked it. It made me choose this college. In my spare time, I like to play basketball, go to the theater, travel and explore new things.";

    $result = $txt."\n\n\n".$txt1."\n";

    $word->Selection->TypeText($result);

    $filename = tempnam(sys_get_temp_dir(), "word");
    $word->Documents[1]->SaveAs($filename);
    
    $word->Quit();
    $word = null;

    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=AleksandarMadic.doc");

    readfile($filename);
    unlink($filename);

?>