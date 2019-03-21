
<?php



require_once "../includeCustomers/classes/customerClass.php";



?>


<header class="mainChild header">
            <section class="headerSection1 headerSection">
                <a href="#"><img src="https://img.icons8.com/material/24/000000/facebook.png"></a>
                <a href="#"><img src="https://img.icons8.com/material/24/000000/instagram-new.png"></a>
                <a href="#"><img src="https://img.icons8.com/metro/26/000000/twitter.png"></a>
            </section>

            <section class="headerSection2 headerSection">
            <a href="../../index.php"><img src="/imgs/logo.png"></a>

            </section>
            
            <section class="headerSection3 headerSection">

                
                <!-- <div class="notLoggedInContainerTrue notLoggedInContainerFalse">
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
                </div> -->
                <?php 
                            if(isset($_POST['login'])) {

                                $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_MAGIC_QUOTES);
                                $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

                                $user2 = new Customers(); 

                                if ($user2->login($username, $password)) {
                                    header('Location: startsida.php');

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
                     
                    <form method="post">
                        <input type="submit" value="logga ut" name="logout">
                    </form>
                    <?php// } else { ?>
                    <div class="notLoggedIn">
                        <form method="post" class="form">
                            <h2> Logga in </h2>
                            <input type="text" name="user" placeholder="Username" class="effect-19 login" min="6"><br>
                            <input type="password" name="pass" placeholder="Password"  class="effect-19 login" min="6"><br>
                            <input type="submit" name="login" value="Logga in" class="effect-19 loginBtn" ><br> 
                        </form>
                        <a href="skapaAcc.php"> Skapa konto </a>
                    </div>
             <?php// } ?>

             

            </section>
        </header>
        <nav class="mainChild nav">
            <section class="navSection navSection1">
            </section>

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
            </section>

            <section class="navSection navSection3">
            </section>

        </nav>