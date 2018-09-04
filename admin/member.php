<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "Member";
    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID!=1");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        ?>
        <div class="container">
            <h1 class="text-center">Mange Member</h1>
            <div class="table-responsive">
                <table class="table text-center  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Controll</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo " <th scope='row'>" . $row['UserID'] . "</th>";
                        echo " <td>" . $row['Username'] . "</td>";
                        echo " <td>" . $row['Email'] . "</td>";
                        echo " <td>" . $row['FullName'] . "</td>";
                        echo " <td>" . $row['Date'] . "</td>";
                        echo " <td>
                                         <a href='member.php?do=Edit&userid=" . $row['UserID'] . "'class='btn_edit btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit </a>
                                         <a href='member.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
           </div>
           <a href="member.php?do=Add" class="btn btn-info"><i class="fa fa-plus"></i> Add New Member</a>
        </div>
   <?php 
} elseif ($do == "Add") { ?>

        <div class="Add">
                <div class="container">
                    <h1 class="text-center">Add Member</h1>
                    <form class="edit_form" action ="?do=insert" method="POST">
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">User Name</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" required="required" autocomplete="off" name="user" placeholder="User Name To Into Login Shop">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control password"  required="required" autocomplete="new-password" name="password" placeholder="Password Must Be Hard And Compliex">
                                <i class="show-pass fa fa-eye" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" required="required" autocomplete="off" name="email" placeholder="Must Be Valid Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-2 col-form-label">Full Name</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" required="required" autocomplete="off" name="full" placeholder="Full Name Apper in Your Ptofile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-3">
                                <input type="submit" value="Add Member" class="form-control btn btn-light">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php 
    } elseif ($do == "insert") {
        echo "<h1 class='text-center'>Insert Member</h1>";

        $userid = $_SESSION['UserID'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $useranme = $_POST['user'];
            $email = $_POST['email'];
            $full = $_POST['full'];
            $pass = $_POST['password'];
            $hashedpass = sha1($pass);

            $formErors = array();
                //VAldiate The Form
            if (empty($useranme)) {

                $formErors[] = " User Name Can't Be <strong>Empty!</strong>";

            }
            if (empty($email)) {

                $formErors[] = "Email Can't Be <strong>Empty!</strong>";

            }
            if (empty($full)) {

                $formErors[] = "Full Name Can't Be <strong>Empty!</strong></div>";

            }
            foreach ($formErors as $error) {
                echo "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'>" . $error . "</div>";
            }

            if (empty($formErors)) {
                    //SQL Statemnt
                $stmt = $con->prepare("INSERT INTO users ( Username, Password, Email, FullName,Date) VALUES (:zuser,:zpass,:zmail,:zname,now() ) ");
                $stmt->execute(array(
                    'zuser' => $useranme,
                    'zpass' => $hashedpass,
                    'zmail' => $email,
                    'zname' => $full
                ));

                $count = $stmt->rowCount();

                echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " Member Added To Database</div>";

            }
        } else {
            $errormsg = "You Cant Reach To this page Dierctly";
            redirectHome($errormsg,4);
        }

    } elseif ($do == "Edit") {//Edit Page 

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $stmt = $con->prepare("SELECT * FROM  users WHERE UserID = ? LIMIT  1");

        $stmt->execute(array($userid));

        $row = $stmt->fetch();

        $count = $stmt->rowCount();

        if ($count > 0) { ?>
                <div class="Edit">
                    <div class="container">
                        <h1 class="text-center">Edit Member</h1>
                        <form class="edit_form" action ="?do=update" method="POST">
                            <input type="hidden" value="<?php echo $userid ?>" name="userid">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-md-2 col-form-label">User Name</label>
                                <div class="col-md-5">
                                    <input type="text" value="<?php echo $row['Username'] ?>" class="form-control" required="required" autocomplete="off" name="user">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-5">
                                    <input type="hidden"  name="oldpassword" value="<?php echo $row['Password']; ?>">
                                    <input type="password" class="form-control"  autocomplete="new-password" name="newpassword" placeholder="Leave Blank If You Wan't Change">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-5">
                                    <input type="email" value="<?php echo $row['Email'] ?> " class="form-control" required="required" autocomplete="off" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-md-2 col-form-label">Full Name</label>
                                <div class="col-md-5">
                                    <input type="text" value="<?php echo $row['FullName'] ?>"class="form-control" required="required" autocomplete="off" name="full">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-md-2 col-md-3">
                                    <input type="submit" value="Save" class="form-control btn btn-light">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        <?php 
    }

} elseif ($do == "update") { //Show Update Message

    echo "<h1 class='text-center'>Update Member</h1>";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $userid = $_POST['userid'];
        $useranme = $_POST['user'];
        $email = $_POST['email'];
        $full = $_POST['full'];



        $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

        $formErors = array();
            //VAldiate The Form
        if (empty($useranme)) {

            $formErors[] = "<div class='text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> User Name Can't Be <strong>Empty!</strong></div>";

        }
        if (empty($email)) {

            $formErors[] = "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'> Email Can't Be <strong>Empty!</strong></div>";

        }
        if (empty($full)) {

            $formErors[] = "<div class=' text-center alert alert-danger' style ='width: 700px; font-size: 21px; margin: 10px auto 5px'> Full Name Can't Be <strong>Empty!</strong></div>";

        }
        foreach ($formErors as $error) {
            echo $error;
        }

        if (empty($formErors)) {
                //SQL Statemnt
            $stmt = $con->prepare("UPDATE users SET Username = ?,Email = ?,FullName = ?, Password = ? WHERE UserID = ?");
            $stmt->execute(array($useranme, $email, $full, $pass, $userid));
            $count = $stmt->rowCount();
            echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " record Updated</div>";

        }
    } else {
        $errormsg = "You Cant Reach To this page Dierctly";
        redirectHome($errormsg, 4);
    }
} elseif ($do == "Delete") {

    echo "<h1 class='text-center'>Delte Member</h1>";

    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $con->prepare("SELECT * FROM  users WHERE UserID = ? LIMIT  1");
    $stmt->execute(array($userid));
    $count = $stmt->rowCount();

    if ($count > 0) {
        $stmt = $con->prepare("DELETE  FROM users WHERE UserID = ? ");
        $stmt->execute(array($userid));
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