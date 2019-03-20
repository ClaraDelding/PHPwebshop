
<?php


session_start();

include "../include/includeCustomers.php";
include "../include/generic/header.php";


if(isset($_POST['change'])) {
  
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_MAGIC_QUOTES);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_MAGIC_QUOTES);
    $extension = filter_input(INPUT_POST, 'extension', FILTER_SANITIZE_MAGIC_QUOTES);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_MAGIC_QUOTES);
    $officeCode = filter_input(INPUT_POST, 'officeCode', FILTER_SANITIZE_MAGIC_QUOTES);
    $reportsTo = filter_input(INPUT_POST, 'reportsTo', FILTER_SANITIZE_NUMBER_INT);
    $jobTitle = filter_input(INPUT_POST, 'jobTitle', FILTER_SANITIZE_MAGIC_QUOTES);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES);

    $user = new Customers(); 

    if ($user->editUser($lastName, $firstName, $extension, $email, $officeCode, 
                        $reportsTo, $jobTitle, $username, $password)) {
        echo "<br>Användare ändrad<br>";
    } else { 
        echo "Couldn't change user<br>";
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

    <h1> <i>Mitt Konto</i> </h1>
    
    <form method="post"> 
        <?php
        if(isset($_SESSION['logged_in'])) {

            
            $user = new Customers();
            $user->view();
        
        ?>
        <input type="submit" name="change" value="Ändra">
        
        <?php } else { echo "Du måste logga in först :)"; }  ?>
    </form>
    


</body>
</html>



