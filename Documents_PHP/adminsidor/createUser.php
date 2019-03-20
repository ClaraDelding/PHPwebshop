
<?php


session_start();


include "../include/includeAdmin.php";
include "../include/generic/header.php";

if(isset($_POST['registerAdmin'])) {

    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_MAGIC_QUOTES);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_MAGIC_QUOTES);
    $extension = filter_input(INPUT_POST, 'extension', FILTER_SANITIZE_MAGIC_QUOTES);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_MAGIC_QUOTES);
    $officeCode = filter_input(INPUT_POST, 'officeCode', FILTER_SANITIZE_MAGIC_QUOTES);
    $reportsTo = filter_input(INPUT_POST, 'reportsTo', FILTER_SANITIZE_NUMBER_INT);
    $jobTitle = filter_input(INPUT_POST, 'jobTitle', FILTER_SANITIZE_MAGIC_QUOTES);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES);
    $admin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT);

    // echo "$username <br> $corpName <br> $firstname <br> $lastname <br> $phone <br> $address1
    // <br> $address2 <br> $city <br> $state <br> $postalcode <br> $country <br> $password";

    // $user = new User2(); 

    $user = new Admin(); 

    // reportsTo
    if ($user->registerAdmin($lastName, $firstName, $extension, $email, $officeCode, $reportsTo, 
            $jobTitle, $username, $password, $admin)) {
                header('Location: login.php');
        exit;
    } else { 
    }
}
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Page Title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="">
<script src="main.js"></script>
</head>
<body>

    

    <div class="container">
        <div class="row bg_1">
            <? if(isset($_SESSION['logged_in'])): ?>
            
            <form method="post" class="">

                <h1><i> Skapa ny anställd </i></h1>


                <div class="col-3 input-effect">
                    <input type="text" name="firstName" class="effect-19" placeholder="">
                    <label>firstName</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                

                <div class="col-3 input-effect">
                    <input type="text" name="lastName" class="effect-19" placeholder="">
                    <label>lastName</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="extension" class="effect-19" placeholder=""><br>
                    <label>extension</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="email" class="effect-19" placeholder=""><br>
                    <label>email</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
            
                <div class="col-3 input-effect">
                    <input type="text" name="officeCode" class="effect-19" placeholder=""><br>
                    <label>officeCode</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                
                <div class="col-3 input-effect">
                    <input type="text" name="reportsTo" class="effect-19" placeholder=""><br>
                    <label>reportsTo</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="jobTitle" class="effect-19" placeholder=""><br>
                    <label>jobTitle</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>




                <div class="col-3 input-effect">
                    <input type="text" name="username" class="effect-19" placeholder=""><br>
                    <label>username</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="password" name="password" class="effect-19" placeholder=""><br>
                    <label>password</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                <div class="col-3 input-effect">
                    <input type="text" name="admin" class="effect-19" placeholder=""><br>
                    <label>admin</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                
                <div class="col-3 input-effect regContainer">
                    <input type="submit" name="registerAdmin" class="effect-19 reg" value="Register"><br>
                    <label></label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
            </form>
            <?php else: ?>

           <p> För att skapa en användare behöver du logga in </p><br>



            <?php endif;?>
        </div>
</div>
    <div class="section section2">
    </div>


    <!-- Börjar -->
    

<!-- Slutar -->
</body>
</html>


