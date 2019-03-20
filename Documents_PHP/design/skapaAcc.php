<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skapa Konto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
    <link rel="stylesheet" type="text/css" media="screen" href="skapaAcc.css">

    <script src="main.js"></script>
    
</head>
<body>

    <div class="container">

       <?php include 'header.php' ?>

        

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
                                <input type="text" name="firstname" class="effect-19" placeholder="Contact Firstname"><br>
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="lastname" class="effect-19" placeholder="Contact Lastname"><br>
                            </div>
                        
                            <div class="col-3 input-effect">
                                <input type="text" name="phone" class="effect-19" placeholder="Phonenumber"><br>
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="address1" class="effect-19" placeholder="Address1"><br>
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="address2" class="effect-19" placeholder="Address2"><br>
                            </div>




                            <div class="col-3 input-effect">
                                <input type="text" name="city" class="effect-19" placeholder="City"><br>
                            </div>

                            <div class="col-3 input-effect">
                                <input type="text" name="state" class="effect-19" placeholder="State"><br>
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="postalcode" class="effect-19" placeholder="Postalcode"><br>
                            </div>
                            
                            <div class="col-3 input-effect">
                                <input type="text" name="country" class="effect-19" placeholder="Country"><br>
                            </div>

                            <div class="col-3 input-effect">
                                <input type="password" name="pass" class="effect-19" placeholder="password"><br>
                            </div>
                        
                            <div class="col-3 input-effect regContainer">
                                <input type="submit" name="register" class="effect-19 reg" value="Register"><br>
                            </div>

                    </form>
            </div>
        

        </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div>



    <!-- <div class="footer-inner">
  <div>One</div>
  <div>Two</div>
  <div>Three</div>
  <div>Four</div>
</div> -->

</body>
</html>


