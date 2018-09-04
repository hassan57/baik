
<?php 
//InClude Databas Connection
    include "connect.php";

    //Routs
    $tpl   = "includes/template/"; 
    $langs = "includes/lang/";
    $fun   = "includes/function/";  
    $css   = "layout/css/";
    $js    = "layout/js/";  
  

    //includes Files
    include $fun   . "function.php";
    include $langs  . "english.php";
    include $tpl    . "header.php";

    if(!isset($nonavbar)){
        include $tpl . "navbar.php";
    }


?>