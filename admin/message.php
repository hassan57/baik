<?php 

session_start();

if (isset($_SESSION['Username'])) {

    $pageTitle = "Messages";

    include "inti.php";

    $do = isset($_GET['do']) ? $_GET['do'] : "Mange";

    if ($do == "Mange") {

        $stmt = $con->prepare("SELECT * FROM messages");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        ?>
        <div class="contain">
            <h1 class="text-center">Mange Messages</h1>
            <br>
            <div class="table-responsive">
                <table class="table text-center  table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Message</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date</th>
                            <th scope="col">Controll</th>
                        </tr>
                    </thead>
                    <?php 
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo " <th scope='row'>" . $row['mes_id'] . "</th>";
                        echo " <td>" . $row['Name'] . "</td>";
                        echo " <td>" . $row['Message'] . "</td>";
                        echo " <td>" . $row['Email'] . "</td>";
                        echo " <td>" . $row['Date'] . "</td>";
                        echo " <td>
                            <a href='message.php?do=Delete&mesid=" . $row['mes_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
           </div>
           
        </div>
   <?php 
} elseif ($do == "Delete") {

    echo "<h1 class='text-center'>Delte Reservation</h1>";

    $mes_id = isset($_GET['mesid']) && is_numeric($_GET['mesid']) ? intval($_GET['mesid']) : 0;

    $stmt = $con->prepare("SELECT * FROM  messages WHERE mes_id = ? LIMIT  1");
    $stmt->execute(array($mes_id));
    $count = $stmt->rowCount();

    if ($count > 0) {
        $stmt = $con->prepare("DELETE  FROM messages WHERE mes_id = ? ");
        $stmt->execute(array($mes_id));
        echo "<div class=' text-center alert alert-success' style ='width: 700px; font-size: 21px; margin: 30px auto 5px'> " . $count . " record Delete</div>";

    } else {
        echo "the ID is no't Exists";
    }

    include $tpl . "footer.php";

}
} else {
    header("Location: index.php");
}

?>