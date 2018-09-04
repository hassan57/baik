<?php 

        $userid = $_SESSION['UserID'];

        $stmt = $con->prepare("SELECT
                                        Username , FullName  
                                    FROM 
                                        users 
                                    WHERE 
                                        UserID = ? 
                                    LIMIT 1");

    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><?php echo lang("HOME_PAG") ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnav" aria-controls="appnav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="appnav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                       <li class="nav-item">
                    <a class="nav-link" href="member.php"><?php echo lang("MEMBER") ?></a>
                </li>
                    <a class="nav-link" href="categroy.php"><?php echo lang("CATGEROIS") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items.php"><?php echo lang("ITEMS") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="special.php">Special</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="reserv.php"><?php echo lang("Reservation") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="message.php">Message</a>
                </li> 
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <?php echo $row['FullName'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="member.php?do=Edit&userid=<?php echo $_SESSION['UserID']?>"><?php echo lang ("EDIT_POR")?></a>
                       
                        <a class="dropdown-item" href="logout.php"> <?php echo lang("LOGOUT")?> </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>