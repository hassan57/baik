<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "Resrevation";
    
    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $stmt = $con->prepare("SELECT * FROM resrvtion");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        ?>
        <div class="contain">
            <h1 class="text-center">Mange Reservation</h1>
            <br>
            <div class="table-responsive">
                <table class="table text-center  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">People</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Controll</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo " <th scope='row'>" . $row['res_id'] . "</th>";
                        echo " <td>" . $row['Name'] . "</td>";
                        echo " <td>" . $row['Email'] . "</td>";
                        echo " <td>" . $row['Phone'] . "</td>";
                        echo "<td>" . $row['Number_Guests'] . "</td>";
                        echo " <td>" . $row['Date'] . "</td>";
                        echo " <td>" . $row['Time'] . "</td>";
                        echo " <td>
                            <a href='reserv.php?do=Delete&resid=" . $row['res_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
           </div>
           
        </div>
   <?php 
}
elseif ($do == "Delete") {

    echo "<h1 class='text-center'>Delte Reservation</h1>";

    $res_id = isset($_GET['resid']) && is_numeric($_GET['resid']) ? intval($_GET['resid']) : 0;
    $stmt = $con->prepare("SELECT * FROM  resrvtion WHERE res_id = ? LIMIT  1");
    $stmt->execute(array($res_id));
    $count = $stmt->rowCount();

    if ($count > 0) {
        $stmt = $con->prepare("DELETE  FROM resrvtion WHERE res_id = ? ");
        $stmt->execute(array($res_id));
        echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " record Delete</div>";

    } else {
        echo "the ID is no't Exists";
    }

    include $tpl . "footer.php";

}
}

else {
    header("Location: index.php");
}

?>