<?php
 class debug
 {
     // prints an array with <pre> tags so it is nicly ordered
    function prePrintArray($array)
    {
        echo "<pre>";
        echo "<br>";
        print_r($array);
        echo "<br>";
    }

 }




?>