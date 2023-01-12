<?php

require('controller/frontend.php');

try 
{
    if (isset($_GET['action'])) {

    }
    else {
        home();
    }
}
catch(Exception $e) { 
    $errorMessage = $e->getMessage();
    echo $errorMessage;
}


