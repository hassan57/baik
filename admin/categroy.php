<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "categories";

    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $sort = 'ASC';

        $sort_array = array('ASC' ,'DESC');

        if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
            $sort = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM catrgiries ORDER BY ordering $sort");

        $stmt2->execute();

        $cats = $stmt2->fetchAll();

        ?>
        <div class="container ca">
            <h1 class="text-center">Mange Caregroies</h1>
            <div class="card">
                <div class="card-header">
                    Mange caregroies
                    <span class="ord">ordering: 
                        <a  class="<?php if ($sort == 'ASC'){ echo 'active';}?>" href='?sort=ASC'>ASC </a> | 
                        <a  class="<?php if ($sort == 'DESC'){ echo 'active';}?>" href='?sort=DESC'>DESC </a>
                    </span> 
                </div>
                <div class="card-body">
                    <?php 
                    foreach($cats as $cat){
                        echo "<div class='cat'>";
                            echo "<h3>". $cat['Name'] ."</h3>";
                            echo "<p>"; 
                              if($cat['Descrbtion'] == ""){echo "This Categorie hasn't been Descrbtion";} 
                              else{echo $cat['Descrbtion'];}              
                            echo "</p>";
                             echo " <p> ". $cat['Date'] ." </p> 
                                <a href='categroy.php?do=Edit&catid=" . $cat['catg_id'] . "'class='btn_edit btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit </a>
                                <a href='categroy.php?do=Delete&catid=" . $cat['catg_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                           
                        echo " </div> ";
                        echo "<hr>";
                    }
                    ?>
                </div>   
            </div>   
           <a href="categroy.php?do=Add" class="btn add btn-info"><i class="fa fa-plus"></i> Add New Caregroie</a>
        </div>
   <?php 

    } elseif ($do == "Add") {?>
    
        <div class="Add">
                <div class="container">
                    <h1 class="text-center">Add Categorie</h1>
                    <form class="edit_form" action ="?do=insert" method="POST">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" required="required" autocomplete="off" name="name" placeholder="Name of the categorie">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control"  autocomplete="off" name="des" placeholder="Descripe the categorie">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Ordering</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control"  autocomplete="off" name="num" placeholder="Number the arrang categorie">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-3">
                                <input type="submit" value="Add categorie" class="form-control btn btn-light">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

   <?php } elseif ($do == "insert") {
    echo "<h1 class='text-center'>Insert categorie</h1>";

   
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = $_POST['name'];
        $des = $_POST['des'];
        $num = $_POST['num'];

        $formErors = array();
                //VAldiate The Form
        if (empty($name)) {

            $formErors[] = " User Name Can't Be <strong>Empty!</strong>";

        }

        foreach ($formErors as $error) {
            echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'>" . $error . "</div>";
        }

        if (empty($formErors)) {
                    //SQL Statemnt
            $stmt = $con->prepare("INSERT INTO catrgiries ( Name, Descrbtion, ordering,Date) VALUES (? , ? , ? ,now() ) ");
            $stmt->execute(array($name , $des , $num));

            $count = $stmt->rowCount();

            echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " categorie Added To Database</div>";

        }
    } else {
        $errormsg = "You Cant Reach To this page Dierctly";
        redirectHome($errormsg, 4);
    }


    } elseif ($do == "Edit") {//Edit Page 
        $catg_id = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

        $stmt = $con->prepare("SELECT * FROM  catrgiries WHERE catg_id = ?");

        $stmt->execute(array($catg_id));

        $row = $stmt->fetch();

        $count = $stmt->rowCount();

        if ($count > 0) { ?>
            <div class="Edit">
                    <div class="container">
                        <h1 class="text-center">Edit Categorie</h1>
                        <form class="edit_form" action ="?do=update" method="POST">
                            <div class="form-group row">
                                <label  class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-5">
                                    <input type="hidden" value="<?php echo $catg_id ?>" name="catid">
                                    <input type="text" value="<?php echo $row['Name'] ?>"class="form-control" required="required" autocomplete="off" name="name" placeholder="Name of the categorie">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-2 col-form-label">Describtion</label>
                                <div class="col-md-5">
                                    <input type="text"  value="<?php echo $row['Descrbtion'] ?>"class="form-control"  autocomplete="off" name="des" placeholder="Descripe the categorie">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-2 col-form-label">Ordering</label>
                                <div class="col-md-5">
                                    <input type="number"  value="<?php echo $row['ordering'] ?>"class="form-control"  autocomplete="off" name="num" placeholder="Number the arrang categorie">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-md-2 col-md-3">
                                    <input type="submit" value="Add categorie" class="form-control btn btn-light">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php 
        }
    } elseif ($do == "update") { //Show Update Message

        echo "<h1 class='text-center'>Update categorie</h1>";


        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $name = $_POST['name'];
            $des  = $_POST['des'];
            $num  = $_POST['num'];
            $cat  = $_POST['catid'];

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
                $stmt = $con->prepare("UPDATE catrgiries SET Name = ?,Descrbtion = ?, ordering = ? WHERE catg_id = ?");
                $stmt->execute(array($name, $des, $num,$cat));
                $count = $stmt->rowCount();
                echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " categorie Updated</div>";

            }
        } else {
            $errormsg = "You Cant Reach To this page Dierctly";
            redirectHome($errormsg, 4);
        }

    } elseif ($do == "Delete") {

        echo "<h1 class='text-center'>Delte Member</h1>";

        $cat = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $stmt = $con->prepare("SELECT * FROM  catrgiries WHERE catg_id = ? LIMIT  1");
        $stmt->execute(array($cat));
        $count = $stmt->rowCount();

        if ($count > 0) {
            $stmt = $con->prepare("DELETE  FROM catrgiries WHERE catg_id = ? ");
            $stmt->execute(array($cat));
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