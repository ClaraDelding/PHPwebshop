
<?php


session_start();

include "../include/includeCustomers.php";
include "../include/generic/header.php";



if(isset($_POST['remove'])) {
    $user = new Customers;


    if($user->remove()) {
        header('Location: login.php');

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
    
    <?php 
    if(isset($_SESSION['name'])) {
        echo $_SESSION['name']; 
        } ?>

    <form method="post">
        <input type="submit" name="remove" value="Delete Account">
    </form>
    


</body>
</html>


