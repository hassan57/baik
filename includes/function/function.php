<?php 

function countcat()
{
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT(catg_id) FROM catrgiries");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

function getcat(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM catrgiries");
    $stmt->execute();
    $cats = $stmt->fetchAll();
    return $cats;

}

function getspecial($limit)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM special LIMIT $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

function getcatby($cat_num){
    global $con;
    $stmt = $con->prepare("SELECT * FROM catrgiries WHERE catg_id = ?");
    $stmt->execute(array($cat_num));
    $cats = $stmt->fetchAll();
    return $cats;
}


function getitem($cat_id, $limit)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE cat_id = ?  LIMIT $limit");
    $stmt->execute(array($cat_id));
    $items = $stmt->fetchAll();
    return $items;
}

function getlastitem($cat_id, $limit)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE cat_id = ?  LIMIT 10 OFFSET $limit");
    $stmt->execute(array($cat_id));
    $items = $stmt->fetchAll();
    return $items;

}



?>