
<?php
session_start();


require_once "../includeCustomers/classes/customerClass.php";
$user = new Customers(); 



if(isset($_POST['change'])) {

 
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
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_MAGIC_QUOTES);



    if ($user->editUser($corpName, $firstname, $lastname, $phone, $address1, 
                        $address2, $city, $state, $postalcode, $country, $password)) {
    } else { 
    }   
} 
if(isset($_POST['remove'])) {
  

    if ($user->softDelete()) {
        header('Location: startsida.php');

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
<link rel="stylesheet" type="text/css" media="screen" href="../includeCustomers/css/design.css">
<script src="main.js"></script>
</head>
<body>

    <div class="container">
        <?php  require_once '../includeCustomers/other/header.php'; ?>
            
        <aside class="mainChild aside"></aside>

        <main class="mainChild main"> 
            <div class="row bg_1">

            <h2> Ändra konto </h2>
            <form method="post"> 
                <h1> <i>Mitt Konto</i> </h1>

                <?php
                if(isset($_SESSION['logged_in'])) {
                    $user->view();
                ?>
                <input type="submit" name="change" value="Ändra Konto">
                
                <?php } else { echo "Du måste logga in först :)"; }  ?>
                </form>
            </div>

            <div>
            <h2> Ta bort konto </h2>

            <form method="post"> 
                    <input type="submit" value="Ta bort konto" name="remove">
            </form>
            </div>
        </main>
        <aside class="mainChild aside"></aside>
        <footer class="mainChild footer"></footer>
    </div>    


    
</body>
</html>



