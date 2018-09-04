<?php 

session_start();

$nonavbar  = "";
$pageTitle = "Login";

if(isset($_SESSION['Username'])){
    header("Location: dashboard.php");
    
}


include "inti.php";



//Chek The Requeest Method
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedpass = sha1($password);

        $stmt = $con->prepare("SELECT
                                    UserID , Username , Password 
                                FROM 
                                    Users 
                                WHERE 
                                    Username = ? 
                                AND 
                                    Password = ? 
                                AND GroupID = 1");

        $stmt->execute(array($username, $hashedpass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        
        if($count > 0){
            $_SESSION['Username'] = $username;
            $_SESSION['UserID'] = $row['UserID'];
           
            header("Location: dashboard.php");
            exit();   
        }
        
    }


?>

<!--The Login Form Code Html-->
    <div class="mainLogin">
        <div class="container">
            <div class="login">
                <div class="row lgn">
                    <div class="col-md .d-xl-none img">
                        <img src="layout/img/img-01.png">
                    </div>
                    <div class="col-md">
                        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                            <h4>Admin Login</h4>
                            <div class="form-group">
                                <input class="form-control user" name="user" type="text"autocomplete="off" placeholder="User Name">
                                <i class="fa ic fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-control pass" type="password" name="pass" placeholder="Password" autocomplete="new-password">
                                <i class="fa ic fa-lock" aria-hidden="true"></i>
                            </div>
                            <input class="btn btn-light btn-block" type="submit" value="Login">
                            <span class="forget"></span>
                            <span class="New-Account"><a href="#"></a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include $tpl . "footer.php" ?>