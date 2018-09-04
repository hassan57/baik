

<?php 

function lang($pharse)
{

    static $lang = array(

        'LOGO' => "اسم الشركه",
        'HOME_PAG' => "الرئسيه",
        'CATGEROIS' => "الاعددات",
        'EDIT_POR' => "تعديل الملف الشخصى",
        'SETTING' => "الاعدادات",
        'LOGOUT' => "تسجيل خروج",

    );
    return $lang[$pharse];
}



?>