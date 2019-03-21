<!DOCTYPE html <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/header.css">
     <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/main.css">
         <script src="main.js"></script>
</head>
<body>



<?php



require_once "../includeAdmin/classes/adminClass.php";


        

        

?>


<div class="container">

<?php 
require_once '../includeAdmin/other/header.php';


?>




<main class="mainChild main edit"> 
            <div class="row bg_1">
        
                 <h1><i> Edit </i></h1>

                <?php 
                    
                ?>
                 <form method="get" action="#">
                    <select name="table">
                        <option value="-">-</option>
                        <option value="customers">Customer</option>
                        <option value="employees"> Employee</option>
                    </select>
                    <input type="submit" name="showInputs" value="Hämta Inputs">
                </form>
                <form method="post" class="editor">

                    <?php 
                    
                    if(isset($_GET['showInputs']) ) {
                        // && $_GET['table'] == "customers" || $_GET['table'] == "employees"  
                        $selected_val = $_GET['table'];  // Storing Selected Value In Variable

                        
                        $user = new Admin();

                        $user->registerTest2($selected_val);
                        

                    
                    echo "  <div class='col-3 input-effect editContainer'>
                                <input type='submit' name='register' class='effect-19 reg' value='Register'>
                            </div> <br><br>";                               
                    } 
                     ?>
                    </form>
                    
                    
    </div>


</main>

</div>

            
</body>
</html>