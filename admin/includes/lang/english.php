

<?php  

   function lang($pharse){

    static  $lang = array(

        //NAVS LINKS
        'ELHAWARY'   => "Elhawry",
        'HOME_PAG'   => "Home",
        'CATGEROIS' => "Catgerois",
        'ITEMS'      => "Items",
        'MEMBER'     => "Member",
        'STATISTICS' => "Statistics",
        'LOGS'       => "Logs",
        'Reservation'=> "Reservation",

        //User Option
        'EDIT_POR'   => "Edit Portfolio",
        'SETTING'  => "Setting",
        'LOGOUT'     => "Log Out"
        
    );
      
    return $lang[$pharse];
   }



?>