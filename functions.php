<?php
 class debug
 {
     
    function prePrintArray($array)
    {
        echo "<pre>";
        echo "<br>";
        print_r($array);
        echo "<br>";
    }
     
    function logError($nr, $important, $message)
    {
        
    } 
     
     
     
 }




?>