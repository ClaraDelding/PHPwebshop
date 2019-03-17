
<?php


session_start();
include "../include/includeCustomers.php";
include "../include/generic/header.php";



if(isset($_POST['register'])) {

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_MAGIC_QUOTES);
    $corpName = filter_input(INPUT_POST, 'corpName', FILTER_SANITIZE_MAGIC_QUOTES);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_MAGIC_QUOTES);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_MAGIC_QUOTES);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_MAGIC_QUOTES);
    $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_MAGIC_QUOTES);
    $address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_MAGIC_QUOTES);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_MAGIC_QUOTES);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_MAGIC_QUOTES);
    $postalcode = filter_input(INPUT_POST, 'postalcode', FILTER_SANITIZE_MAGIC_QUOTES);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

    // echo "$username <br> $corpName <br> $firstname <br> $lastname <br> $phone <br> $address1
    // <br> $address2 <br> $city <br> $state <br> $postalcode <br> $country <br> $password";

    

    $user = new Customers(); 

    if ($user->register($username, $corpName, $firstname, $lastname, $phone, $address1, 
                        $address2, $city, $state, $postalcode, $country, $password)) {
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
<title>Skapa kund</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="">
<script src="main.js"></script>
</head>
<body>

    
    <form method="post"> 
        <?php
        // $user = new User2();
        // $user->view();
        ?>
    </form>

    <div class="container">
        <div class="row bg_1">
            <? if(isset($_SESSION['logged_in'])): ?>
            Välkommen <strong><?php echo $_SESSION['name']?></strong>!<br>

            <?php else: ?>

            <form method="post" class="">

                <h1><i> Registrera </i></h1>

                <div class="col-3 input-effect">
                    <input type="text" name="user" class="effect-19" placeholder="">
                    <label>Username</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                

                <div class="col-3 input-effect">
                    <input type="text" name="corpName" class="effect-19" placeholder="">
                    <label>Company name</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>



                <div class="col-3 input-effect">
                    <input type="text" name="firstname" class="effect-19" placeholder=""><br>
                    <label>Contact Firstname</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="lastname" class="effect-19" placeholder=""><br>
                    <label>Contact Lastname</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
            
                <div class="col-3 input-effect">
                    <input type="text" name="phone" class="effect-19" placeholder=""><br>
                    <label>Phonenumber</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                
                <div class="col-3 input-effect">
                    <input type="text" name="address1" class="effect-19" placeholder=""><br>
                    <label>Address1</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="address2" class="effect-19" placeholder=""><br>
                    <label>Address2</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>




                <div class="col-3 input-effect">
                    <input type="text" name="city" class="effect-19" placeholder=""><br>
                    <label>City</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>

                <div class="col-3 input-effect">
                    <input type="text" name="state" class="effect-19" placeholder=""><br>
                    <label>State</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                <div class="col-3 input-effect">
                    <input type="text" name="postalcode" class="effect-19" placeholder=""><br>
                    <label>postalcode</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                
                <div class="col-3 input-effect">
                    <input type="text" name="country" class="effect-19" placeholder=""><br>
                    <label>Country</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                <div class="col-3 input-effect">
                    <input type="password" name="pass" class="effect-19" placeholder=""><br>
                    <label>Password</label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
                <div class="col-3 input-effect regContainer">
                    <input type="submit" name="register" class="effect-19 reg" value="Register"><br>
                    <label></label>
                    <span class="focus-border">
                        <i></i>
                    </span>
                </div>
            </form>

                
                
<!-- 
                    Contact Firstname:<br>
                    <input type="text" name="firstname"><br>

                    Contact Lastname:<br>
                    <span class="focus-border"></span>

                    <input type="text" name="lastname"><br>
                    phone:<br>
                    <span class="focus-border"></span>

                

                    <input type="text" name="address2"><br>
                    <span class="focus-border"></span>

                    </div>
                <div class="part part2">
                    city:<br>
                    <input type="text" name="city"><br>
                    <span class="focus-border"></span>

                    state:<br>
                    <input type="text" name="state"><br>
                    postalcode:<br>
                    <span class="focus-border"></span>

                    <input type="text" name="postalcode"><br>
                    country:<br>
                    <span class="focus-border"></span>

                    <input type="text" name="country"><br>
                    Password:<br>
                    <input type="password" name="pass"><br>
                    <span class="focus-border"></span>

                    Confirm Password:<br>
                    <input type="password" name=""><br>
                    <span class="focus-border"></span>

                    <br>
                    <input type="submit" name="register" value="Register" class="reg"><br> 
                </div>
                
            </form> -->
            <?php endif;?>
        </div>
</div>
    <div class="section section2">
    </div>


    <!-- Börjar -->
    

<!-- Slutar -->
</body>
</html>


