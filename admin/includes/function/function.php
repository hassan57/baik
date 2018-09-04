<?php 

function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){
        echo $pageTitle;
    }
    else {
        echo "Deafult";
    }
}

/*Redirect Home*/

function redirectHome($errormsg,$sec=3){
    echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'>$errormsg</div>";
    echo "<div class=' text-center alert alert-info' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> You Will Redirctly To home page in $sec Seconds </div>";
    header("refresh:$sec;url=dashboard.php");
    exit();
}


/*Check Number Of Count*/

function countitem($item,$table){
    global $con;
    $stmt2 =$con->prepare("SELECT COUNT($item) FROM $table");

    $stmt2 ->execute();

    return $stmt2->fetchColumn();
}

function latest($select,$table,$order,$limit){
    global $con;

    $stmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

    $stmt->execute();

    return $stmt->fetchAll();
}

?>