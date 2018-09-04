<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "Items";
    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $stmt = $con->prepare("SELECT
                                    special.*,
                                    users.Username  As admin_name
                                FROM
                                    special
                                INNER JOIN users ON users.UserID = special.mem_id");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        ?>
        <div class="container ">
            <h1 class="text-center">Mange Special</h1>
            <div class="table-responsive">
                <table class="table item text-center  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">image</th>
                            <th scope="col">Offer</th>>
                            <th scope="col">Admin Name</th>
                            <th scope="col"> Date</th>
                            <th scope="col">Controll</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo " <th scope='row'>" . $row['id'] . "</th>";
                        echo " <td>" . $row['name'] . "</td>";
                        echo " <td><img class='itemimg' src= 'uploads/" . $row['img'] . "'></td>";
                        echo " <td>" . $row['offer'] . "</td>";
                        echo " <td>" . $row['admin_name'] . "</td>";
                        echo " <td>" . $row['date'] . "</td>";
                        echo " <td>
                                <a href='special.php?do=Edit&speid=" . $row['id'] . "'class='btn_edit btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit </a>
                                <a href='special.php?do=Delete&speid=" . $row['id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <a href="special.php?do=Add" class="btn btn-info"><i class="fa fa-plus"></i> Add New Special</a>

           </div>
           
        </div>
   <?php 
} elseif ($do == "Add") {

    ?>
        <div class="Add">
                <div class="container">
                    <h1 class="text-center">Add special</h1>
                    <form class="edit_form" action ="?do=insert" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" required="required" autocomplete="off" name="name" placeholder="Name of the special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">offer</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control"  required="required"autocomplete="off" name="offer" placeholder="offer of the special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-5">
                                <input type="file"  class="form-control"  autocomplete="off" name="item_image" placeholder="Image Of the special">
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
                                <input type="submit" value="Add Special" class="form-control btn btn-light">
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
    
        $name = $_POST['name'];
        $offer = $_POST['offer'];
        $mebid = $_POST['meb_id'];

        $formErors = array();
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

            $stmt = $con->prepare("INSERT INTO special ( name, offer, date , mem_id, img) VALUES ( ?, ?,now(),? ,?) ");
            $stmt->execute(array($name,$offer, $mebid, $img));
            $count = $stmt->rowCount();

            echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " items Added To Database</div>";

        }
    } else {
        $errormsg = "You Cant Reach To this page Dierctly";
        redirectHome($errormsg, 4);
    }


} elseif ($do == "Edit") {//Edit Page 
    $spe_id = isset($_GET['speid']) && is_numeric($_GET['speid']) ? intval($_GET['speid']) : 0;

    $stmt = $con->prepare("SELECT * FROM  special WHERE id = ?");

    $stmt->execute(array($spe_id));

    $row = $stmt->fetch();

    $count = $stmt->rowCount();

    $join_c_m = $con->prepare("SELECT
                                special.mem_id,
                                users.Username as admin_name
                                FROM
                                special
                                INNER JOIN users ON users.UserID = special.mem_id WHERE id =?");

    $join_c_m->execute(array($spe_id));

    $cats = $join_c_m->fetch();

    if ($count > 0) { ?>
        <div class="Edit">
                <div class="container">
                    <h1 class="text-center">Add special</h1>
                    <form class="edit_form" action ="?do=update" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-5">
                          <input type="hidden" value="<?php echo $spe_id ?>" name="speid">

                                <input type="text" value="<?php echo $row['name']?>" class="form-control" required="required" autocomplete="off" name="name" placeholder="Name of the special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">offer</label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $row['offer'] ?>"class="form-control"  required="required"autocomplete="off" name="offer" placeholder="offer of the special">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-5">
                                <input type="file" value="<?php echo $row['img'] ?>"  class="form-control"  autocomplete="off" name="item_image" placeholder="Image Of the Items">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Member</label>
                            <div class="col-md-5">
                                <select class="form-control" name="meb_id">
                                    <?php

                                    echo "<option value='" . $cats['mem_id'] . "'>" . $cats['admin_name'] . "</option>";

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
                                <input type="submit" value="Edit Special" class="form-control btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
        }
    } elseif ($do == "update") { //Show Update Message

        echo "<h1 class='text-center'>Update Specail</h1>";


        if ($_SERVER['REQUEST_METHOD'] == "POST") {


      

            $speid = $_POST['speid'];
            $name = $_POST['name'];
            $offer = $_POST['offer'];
            $mebid = $_POST['meb_id'];
            $imgname = $_FILES['item_image']['name'];
            $imgtmp = $_FILES['item_image']['tmp_name'];
            


            $formErors = array();
                //VAldiate The Form
            if (empty($name)) {
                $formErors[] = "  Name Can't Be <strong>Empty!</strong>";
            }

            foreach ($formErors as $error) {
                echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'>" . $error . "</div>";
            }

            if (empty($formErors)) {
                    //SQL Statemnt
                $img = rand(0, 1000000) . '_' . $imgname;
                move_uploaded_file($imgtmp, "uploads\\" . $img);

                $stmt = $con->prepare("UPDATE special SET name = ?, offer = ?, mem_id=?, img = ? WHERE id = ?");

                $stmt->execute(array($name, $offer, $mebid, $img , $speid));

                $count = $stmt->rowCount();
                echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " item Updated</div>";

            }
        } else {
            $errormsg = "You Cant Reach To this page Dierctly";
            redirectHome($errormsg, 4);
        }

    } elseif ($do == "Delete") {

        echo "<h1 class='text-center'>Delte Member</h1>";

        $spe_id = isset($_GET['speid']) && is_numeric($_GET['speid']) ? intval($_GET['speid']) : 0;
        $stmt = $con->prepare("SELECT * FROM  special WHERE id = ? LIMIT  1");
        $stmt->execute(array($spe_id));
        $count = $stmt->rowCount();

        if ($count > 0) {
            $stmt = $con->prepare("DELETE  FROM special WHERE id = ? ");
            $stmt->execute(array($spe_id));
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