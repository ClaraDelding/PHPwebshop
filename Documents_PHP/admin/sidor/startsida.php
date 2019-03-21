<!DOCTYPE html <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/main.css">
    <script src="main.js"></script>
</head>
<body>



<?php



require_once "../includeAdmin/classes/adminClass.php";



?>


<header class="mainChild header">

            <div class="logoImg">
                <a href="../../index.php"><img src="/imgs/logo.png"></a>
            </div>
            
            <section class="headerSection3 headerSection">

                
<<<<<<< HEAD
                <!-- <div class="notLoggedInContainerTrue notLoggedInContainerFalse">
=======
                <div class="notLoggedInContainerTrue notLoggedInContainerFalse">
>>>>>>> origin/ClarasFrånAxelsDevBranch
                    <article class="notLoggedIn">
                        Logga In 
                        <div class="logIn">
                            <form>
                                <input type="text" name="username" placeholder="username">
                                <input type="password" name="password" placeholder="password">
                                <input type="submit" name="login" value="Logga in">
                            </form>                           
                        </div>
                    </article>   
                  
                </div>
                <div class="loggedInContainerFalse">
                    <a href="#"> Mitt Konto </a>
<<<<<<< HEAD
                </div> -->
=======
                </div>
>>>>>>> origin/ClarasFrånAxelsDevBranch
                <?php 
                            if(isset($_POST['login'])) {

                                $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_MAGIC_QUOTES);
                                $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

                                $user = new Admin(); 

                                if ($user->login($username, $password)) {
                                    header('Location: skapaAccAdmin.php');

                                } else { 
                                    echo "Användarnamn eller lösenord finns inte";
                                }
                            }

                            // Logga ut
                            if(isset($_POST['logout'])) {
                                header('Location: startsida.php');
                                $_SESSION = array();
                            }
                    ?>
                <? if(isset($_SESSION['logged_in'])) { ?>
                    <a href="kontosida.php"> Mitt Konto </a> 
                     
<<<<<<< HEAD
                    <form method="post">
=======
                     <form method="post">
>>>>>>> origin/ClarasFrånAxelsDevBranch
                        <input type="submit" value="logga ut" name="logout">
                    </form>
                    <?php } else { ?>
                    <div class="logInContainer">
                        <form method="post" class="form">
                            <h2> Logga in </h2>
                            <input type="text" name="user" placeholder="Username" class="logIn" min="6"><br>
                            <input type="password" name="pass" placeholder="Password"  class="logIn" min="6"><br>
                            <input type="submit" name="login" value="Logga in" class="logIn" ><br> 
                        </form>
                    </div>
             <?php } ?>

             

            </section>
        </header>
        <nav class="mainChild nav">
            <section class="navSection navSection1">
            </section>
<<<<<<< HEAD
<!-- 
=======

>>>>>>> origin/ClarasFrånAxelsDevBranch
            <section class="navSection navSection2">
                <div class="navItemsContainer">
                    <article class="navItems navItem1">
                        <a href="startsida.php" class="parts part1 aLeft"> Start </a>
                    </article>
                    <article class="navItems navItem2">
                        <a href="produkter.php" class="parts part2 aLeft"> Produkter </a>
                    </article>
                    <article class="navItems navItem3">
                        <form>
                            <input class="parts part3" type="text" placeholder="Sök">
                            <input class="part3_search" type="submit" placeholder="Sök">
                        </form>
                    </article>
                    <article class="navItems navItem4">
                        <a href="#" class="parts part4 aRight"> Om oss </a>
                    </article>
                    <article class="navItems navItem5">
                        <a href="#" class="parts part5 aRight"> Kontakta oss </a>
                    </article>            
                </div>
<<<<<<< HEAD
            </section> -->
=======
            </section>
>>>>>>> origin/ClarasFrånAxelsDevBranch

            <section class="navSection navSection3">
            </section>

        </nav>

            
</body>
</html>