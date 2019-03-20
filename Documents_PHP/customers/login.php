
<?php


session_start();

include "../include/includeCustomers.php";


if(isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

    echo $username . " and pass: " . $password . "<br>";
    $user = new Customers(); 

    if ($user->login($username, $password)) {
        echo "Logged in<br>";
    } else { 
        echo "Not logged in";
    }
}

// Logga ut
if(isset($_POST['logout'])) {

    $_SESSION = array();
    echo "Utloggad";
}
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Logga in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
<script src="main.js"></script>
</head>
<body>
    <!-- Innan header -->
<?php include "../include/generic/header.php"; ?>

    <h1><i> Logga in </i></h1>


    <? if(isset($_SESSION['logged_in'])) { ?>
    Välkommen <strong><?php echo $_SESSION['name']?></strong>!<br>
    <form method="post">
        <input type="submit" value="logga ut" name="logout">
    </form>
    <?php } else { ?>
    <div class="loginContainer">
        <form method="post" class="form">
            Username:<br>
            <input type="text" name="user" class="effect-19 login" min="6"><br>
            Password:<br>
            <input type="password" name="pass" class="effect-19 login" min="6"><br>
            <input type="submit" name="login" value="Logga in" class="effect-19 loginBtn" ><br> 
        </form>
    </div>
    <?php } ?>
   
</body>
</html>


