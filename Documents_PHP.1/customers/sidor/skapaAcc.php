<?php
session_start();
require_once "../includeCustomers/classes/customerClass.php";


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

    $user = new Customers(); 

    if ($user->register($username, $corpName, $firstname, $lastname, $phone, $address1, 
                        $address2, $city, $state, $postalcode, $country, $password)) {
        header('Location: startsida.php');
        exit;
    } else { 
    }   
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skapa Konto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeCustomers/css/design.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeCustomers/css/skapaAcc.css">

    <script src="main.js"></script>
    
</head>
<body>

    <div class="container">

        <?php require_once '../includeCustomers/other/header.php' ?>

        <aside class="mainChild aside">ASide vänster</aside>
        <main class="mainChild main"> 
                    <div class="row bg_1">
                
                        <form method="post" class="">

                            <h1><i> Registrera </i></h1>

                            <div class="col-3 input-effect">
                                <input type="text" name="user" class="effect-19" placeholder="Username">
                            </div>
                            

                            <div class="col-3 input-effect">
                                <input type="text" name="corpName" class="effect-19" placeholder="Company Name">
                            </div>



                            <div class="col-3 input-effect">
                                <input type="text" name="firstname" class="effect-19" placeholder="Contact Firstname">
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="lastname" class="effect-19" placeholder="Contact Lastname">
                            </div>
                        
                            <div class="col-3 input-effect">
                                <input type="text" name="phone" class="effect-19" placeholder="Phonenumber">
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="address1" class="effect-19" placeholder="Address1">
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="address2" class="effect-19" placeholder="Address2">
                            </div>




                            <div class="col-3 input-effect">
                                <input type="text" name="city" class="effect-19" placeholder="City">
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="state" class="effect-19" placeholder="State">
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="postalcode" class="effect-19" placeholder="Postalcode">
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="country" class="effect-19" placeholder="Country">
                            </div>

                            <div class="col-3 input-effect">
                                <input type="password" name="pass" class="effect-19" placeholder="password">
                            </div>
                        
                            <div class="col-3 input-effect regContainer">
                                <input type="submit" name="register" class="effect-19 reg" value="Register">
                            </div>

                    </form>
            </div>
        

        </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div>
</body>
</html>


