
<?php


session_start();

include "../include/includeCustomers.php";
include "../include/generic/header.php";



if(isset($_POST['change'])) {

    // Kanske göra denna tlll en array?
  
    $corpName = filter_input(INPUT_POST, 'customerName', FILTER_SANITIZE_MAGIC_QUOTES);
    $firstname = filter_input(INPUT_POST, 'contactFirstName', FILTER_SANITIZE_MAGIC_QUOTES);
    $lastname = filter_input(INPUT_POST, 'contactLastName', FILTER_SANITIZE_MAGIC_QUOTES);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_MAGIC_QUOTES);
    $address1 = filter_input(INPUT_POST, 'addressLine1', FILTER_SANITIZE_MAGIC_QUOTES);
    $address2 = filter_input(INPUT_POST, 'addressLine2', FILTER_SANITIZE_MAGIC_QUOTES);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_MAGIC_QUOTES);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_MAGIC_QUOTES);
    $postalcode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_MAGIC_QUOTES);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_MAGIC_QUOTES);

    $user = new Customers(); 

    if ($user->editUser($corpName, $firstname, $lastname, $phone, $address1, 
                        $address2, $city, $state, $postalcode, $country)) {
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
    
    <form method="post"> 
        <?php
        if(isset($_SESSION['logged_in'])) {

            
            $user = new User2();
            $user->view();
        
        ?>
        <input type="submit" name="change" value="Ändra">
        
        <?php } else { echo "Du måste logga in först :)"; }  ?>
    </form>
    


</body>
</html>


