<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "Items";
    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $stmt = $con->prepare("SELECT
                                   items.*,
                                    catrgiries.Name AS categroie,
                                    users.Username  As admin_name
                                FROM
                                    items
                                INNER JOIN catrgiries ON catrgiries.catg_id = items.cat_id
                                INNER JOIN users ON users.UserID = items.member_id ORDER BY item_id ASC");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        ?>
        <div class="contain">
            <h1 class="text-center">Mange Items</h1>
            <div class="table-responsive">
                <table class="table item text-center  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Descrbtion</th>
                            <th scope="col">caregroie</th>
                            <th scope="col">Admin Name</th>
                            <th scope="col"> Date</th>
                            <th scope="col">Controll</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo " <th scope='row'>" . $row['item_id'] . "</th>";
                        echo " <td>" . $row['Name'] . "</td>";
                        echo " <td><img class='itemimg' src= 'uploads/" . $row['image'] . "'></td>";
                        echo " <td>" . $row['price'] . "</td>";
                        echo " <td>" . $row['Descrbtion'] . "</td>";
                        echo "<td>"  . $row['categroie']."</td>";
                        echo " <td>" .$row['admin_name']."</td>";
                        echo " <td>" . $row['Date'] . "</td>";
                        echo " <td>
                                    <a href='items.php?do=Edit&itemid=" . $row['item_id'] . "'class='btn_edit btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit </a>
                                    <a href='items.php?do=Delete&itemid=" . $row['item_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                 <a href="items.php?do=Add" class="btn btn-info"><i class="fa fa-plus"></i> Add New Item</a><br>

           </div>
           
        </div>
   <?php 
} elseif ($do == "Add") {

 ?>

   
        <div class="Add">
                <div class="container">
                    <h1 class="text-center">Add Items</h1>
                    <form class="edit_form" action ="?do=insert" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" required="required" autocomplete="off" name="name" placeholder="Name of the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control"  autocomplete="off" name="des" placeholder="Descripe the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Price</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control"  required="required"autocomplete="off" name="price" placeholder="Price the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-5">
                                <input type="file"  class="form-control"  autocomplete="off" name="item_image" placeholder="Image Of the Items">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">categorie</label>
                            <div class="col-md-5">
                                <select class="form-control" name="catg_id">
                                    <option value="0">.........</option>
                                    <?php 
                                        $stmt = $con->prepare("SELECT Name ,catg_id  FROM catrgiries");

                                        $stmt->execute();

                                        $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                        echo "<option value='".$row['catg_id']. "'>". $row['Name'] . "</option>";
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Member</label>
                            <div class="col-md-5">
                                <select class="form-control" name="meb_id">
                                    <option name="meb_id" value="0">.........</option>
                                    <?php 
                                    $stmt = $con->prepare("SELECT Username ,UserID FROM users");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                        echo "<option value='" . $row['UserID'] . "'>" . $row['Username'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-3">
                                <input type="submit" value="Add Items" class="form-control btn btn-light">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

   <?php 
} elseif ($do == "insert") {
    echo "<h1 class='text-center'>Insert Items</h1>";


    if ($_SERVER['REQUEST_METHOD'] == "POST") {



        //image upload
        
        $imgname = $_FILES['item_image']['name'];
        $imgtmp = $_FILES['item_image']['tmp_name'];
        $imgtype = $_FILES['item_image']['type'];

        $img_extention = array("jpeg","jpg","png","gif");
        
        $imgext = strtolower(end(explode('.',$imgname)));

        if(! in_array($imgext, $img_extention)){
            $formErors[] = " You Shoud Enter Valid <strong>Extention!</strong>";
        }
       
        $name = $_POST['name'];
        $des = $_POST['des'];
        $pric = $_POST['price'];
        $catid = $_POST['catg_id'];
        $mebid = $_POST['meb_id'];

        $formErors = array();
                //VAldiate The Form
        if (empty($name)) {
            $formErors[] = " Name Can't Be <strong>Empty!</strong>";
        }

        foreach ($formErors as $error) {
            echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'>" . $error . "</div>";
        }

        if (empty($formErors)) {
                    //SQL Statemnt

            $img = rand(0, 1000000) . '_' . $imgname;
            move_uploaded_file($imgtmp, "uploads\\" . $img);


            $stmt = $con->prepare("INSERT INTO items ( Name, Descrbtion, price, Date, cat_id, member_id,image) VALUES ( ?, ?, ? ,now(),?,? ,?) ");
            $stmt->execute(array($name, $des, $pric, $catid, $mebid,$img));


            $count = $stmt->rowCount();


            


            echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " items Added To Database</div>";

        }
    } else {
        $errormsg = "You Cant Reach To this page Dierctly";
        redirectHome($errormsg, 4);
    }


} elseif ($do == "Edit") {//Edit Page 
    $item_id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

    $stmt = $con->prepare("SELECT * FROM  items WHERE item_id = ?");

    $stmt->execute(array($item_id));

    $row = $stmt->fetch();

    $count = $stmt->rowCount();

   $join_c_m = $con->prepare("SELECT
                                items.cat_id, items.member_id,
                                catrgiries.Name as categroie,
                                users.Username as admin_name
                                FROM
                                items
                                INNER JOIN catrgiries ON catrgiries.catg_id = items.cat_id
                                INNER JOIN users ON users.UserID = items.member_id WHERE item_id =?");
    $join_c_m->execute(array($item_id));
    $cats = $join_c_m->fetch();
    if ($count > 0) { ?>
            <div class="Edit">
                <div class="container">
                    <h1 class="text-center">Edit Items</h1>
                    <form class="edit_form" action ="?do=update" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-5">
                                <input type="hidden" value="<?php echo $item_id ?>" name="itemid">
                                <input type="text" class="form-control" value="<?php echo $row['Name'] ?>" required="required" autocomplete="off" name="name" placeholder="Name of the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" value="<?php echo $row['Descrbtion'] ?>" autocomplete="off" name="des" placeholder="Descripe the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Price</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" value="<?php echo $row['price'] ?>" required="required" autocomplete="off" name="price" placeholder="Price the Items">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-5">
                                <input type="file" value="<?php echo $row['image'] ?>"  class="form-control"  autocomplete="off" name="item_image" placeholder="Image Of the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">categorie</label>
                            <div class="col-md-5">
                                <select class="form-control" name="catg_id">
                                    <?php
                                   
                                        
                                        echo "<option value='" . $cats['cat_id'] . "'>" . $cats['categroie'] . "</option>";

                                        $stmt = $con->prepare("SELECT Name ,catg_id FROM catrgiries");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                    foreach ($rows as $row) {
                                        echo "<option value='" . $row['catg_id'] . "'>" . $row['Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Member</label>
                            <div class="col-md-5">
                                <select class="form-control" name="meb_id">
                                    <?php

                                        echo "<option value='" . $cats['member_id'] . "'>" . $cats['admin_name'] . "</option>";

                                        $stmt = $con->prepare("SELECT Username ,UserID FROM users");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                        foreach ($rows as $row) {
                                            echo "<option value='" . $row['UserID'] . "'>" . $row['Username'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-3">
                                <input type="submit" value="Edit Items" class="form-control btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
        }
    } elseif ($do == "update") { //Show Update Message

        echo "<h1 class='text-center'>Update Items</h1>";


        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            

            

            $name   = $_POST['name'];
            $des    = $_POST['des'];
            $pric   = $_POST['price'];
            $itemid = $_POST['itemid'];
            $catid = $_POST['catg_id'];
            $mebid = $_POST['meb_id'];
            $imgtmp = $_FILES['item_image']['tmp_name'];
            $imgname = $_FILES['item_image']['name'];

            $formErors = array();
                //VAldiate The Form
            if (empty($name)) {
                $formErors[] = "  Name Can't Be <strong>Empty!</strong>";
            }

            foreach ($formErors as $error) {
                echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'>" . $error . "</div>";
            }

            if (empty($formErors)) {
                $img = rand(0, 1000000).'_'.$imgname;
                move_uploaded_file($imgtmp, "uploads\\" . $img);
                
                $stmt = $con->prepare("UPDATE items SET Name = ?,Descrbtion = ?, price = ?,cat_id=?, member_id=?,image =? WHERE item_id = ?");
                $stmt->execute(array($name, $des ,$pric, $catid,$mebid,  $img, $itemid));
                $count = $stmt->rowCount();
                echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " item Updated</div>";

            }
        } else {
            $errormsg = "You Cant Reach To this page Dierctly";
            redirectHome($errormsg, 4);
        }

    } elseif ($do == "Delete") {

        echo "<h1 class='text-center'>Delte Member</h1>";

        $item_id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        $stmt = $con->prepare("SELECT * FROM  items WHERE item_id = ? LIMIT  1");
        $stmt->execute(array($item_id));
        $count = $stmt->rowCount();

        if ($count > 0) {
            $stmt = $con->prepare("DELETE  FROM items WHERE item_id = ? ");
            $stmt->execute(array($item_id));
            echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " record Delete</div>";

        } else {
            echo "the ID is no't Exists";
        }
    } else {
        echo "Not Found page";
    }

    include $tpl . "footer.php";

} else {
    header("Location: index.php");
}

?>