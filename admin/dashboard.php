<?php 

session_start();

if (isset($_SESSION['Username'])) {
    $pageTitle = "Dashboard";
    include "inti.php";?>

    <div class="container text-center">
        <h1>Dashboard</h1>
        <div class="row">
            
            <div class="col-md">
                <div class="stat stat-category">
                     Categories
                    <a href="categroy.php"><span><?php echo countitem('catg_id', 'catrgiries') ?></span></a>
                </div>
            </div>
            <div class="col-md">
                <div class="stat stat-items">
                     Items
                     <a href="items.php"><span><?php echo countitem('item_id', 'items') ?></span></a>
                </div>
            </div>
             <div class="col-md">
                <div class="stat stat-mes">
                       Message
                    <a href="message.php"><span><?php echo countitem('mes_id', 'messages') ?></span></a>
                </div>
            </div>
            <div class="col-md">
                <div class="stat stat-resrv">
                      Resrvetion
                     <a href="reserv.php"><span><?php echo countitem('res_id', 'resrvtion') ?></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="latest text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                             <i class="fa fa-home"></i>Latest Items
                        </div>
                        <div class="card-body last">
                        <?php 
                         $latestitem = latest("*","items","item_id","5");
                          foreach($latestitem as $item){
                                echo "<ul class='list-unstyled'>";
                                    echo"<li>";
                                        echo"<span>".$item['Name']."</span>";
                                        echo"<a href='items.php?do=Edit&itemid=" . $item['item_id'] . "'class='btn_edit btn btn-success'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit </a>";
                                        echo "<div class='clear-flex'></div>";
                                    echo"</li>";
                               echo"</ul>";
                          }
                        
                        ?>
                        </div>   
                    </div>   
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                             <i class="fa fa-home"></i>Latest Resrvrion
                        </div>
                        <div class="card-body last">
                           <?php 
                            $latestreser = latest("*", "resrvtion", "res_id", "5");
                            foreach ($latestreser as $res) {
                                echo "<ul class='list-unstyled'>";
                                    echo "<li>";
                                        echo "<span>" . $res['Name'] . "</span>";
                                        echo "<a href='reserv.php?do=Delete&resid=" . $res['res_id'] . "'class='btn_edit btn btn-danger'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Delete </a>";
                                    echo "<div class='clear-flex'></div>";
                                    echo "</li>";
                                echo "</ul>";
                            }
                            ?>
                        </div>   
                    </div>   
                </div>
            </div>
        </div>
    </div>


    <?php include $tpl . "footer.php";

} else {
    header("Location: index.php");
}

?>