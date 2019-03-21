<?php 

// Admin 2.0
include_once '../../genericInclude/classes/db.php';

class Admin  {

    private $db;
    public $is_logged_in = false;

    public function __construct() {
        // Skapar en ny instans av DB, och sparar den i vårt privata $db. 
        $obj = new DB();
        $this->db = $obj->pdo;
        
    }

      // Inloggning.   
      public function login($user, $pass) {
        
        // Hämta lösenordet koppålat till användarnamnet. 

        $sql = "SELECT password FROM employees WHERE username = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $user]); 
        // Fetchcolumn hämtar ett värde istället för en array i en array. 
        $hash = $stmt->fetchColumn();


        // Verfifiera att lösenordet stämmer överens med hash.
        $this->is_logged_in = password_verify($pass, $hash);


        if($this->is_logged_in) {
            // $sql2 = "SELECT employeeNumber FROM employees WHERE username = :user";
            // $stmt2 = $this->db->prepare($sql2);
            // $stmt2->execute([':user' => $user]); 
            // $right = $stmt2->fetchColumn();

            // $_SESSION['userId'] = $right;
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = "$user";

            foreach($_SESSION as $key => $value) {
                echo "Sessionvärde: $key : $value <br>";
            }
            // $_SESSION['adminRight'] = "$right";
        }
        var_dump($this->is_logged_in);  
        return $this->is_logged_in; 
    }


    // Skapa adminkonto Annan sql, annars samma. 
    public function registerAdmin($lastName, $firstName, $extension, $email, $officeCode, $reportsTo,
        $jobTitle, $username, $password, $admin) {

        // Se om användaren redan finns
        $stmt3 = $this->db->prepare("SELECT * FROM classicmodels.employees WHERE username = :checkUser");
        $stmt3->execute([':checkUser' => $username]);
        $checkUsername = $stmt3->fetchColumn();
        if ($checkUsername) {
            echo "Användarnamnet används redan";
            return false;
        }   
        else {
            // Hämta det högsta Id i tabellen och lägg till 1.  
            $getId = $this->db->prepare("SELECT MAX(employeeNumber) FROM employees");
            $getId->execute();
            $result = ($getId->fetchColumn() + 1);
                
            // hasha lösenordet- 
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("INSERT INTO classicmodels.employees (employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, username, password, admin) 
            VALUES(:employeeNumber, :lastName, :firstName, :extension, :email, :officeCode, :reportsTo, :jobTitle,:username, :password, :admin)");
            // :reportsTo
    
            $stmt->bindValue(':employeeNumber', $result, PDO::PARAM_INT);
            $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':extension', $extension, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
            $stmt->bindValue(':reportsTo', $reportsTo, PDO::PARAM_INT);
            $stmt->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':admin', $admin, PDO::PARAM_INT);
            $stmt->execute(); 

            return true; 
        }
    }

    // se användaruppgifter.  Annan sql, annars samma. 
    public function view() {
        $user = $_SESSION['user'];
        
        $stmt2 = $this->db->prepare("SELECT lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, username FROM employees WHERE username = :user");
        $stmt2->execute([':user' => $user]); 
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
        foreach($result as $col) {
            foreach($col as $col => $value) {   
                echo "<pre>";
                echo "$col <br> <input value='$value' name='$col'>";   
                echo "</pre>";            
            }
        }
    }

    // Ändra användaruppgifter - oklar.
    function editUser($lastName, $firstName, $extension, $email, 
    $officeCode, $reportsTo, $jobTitle, $username, $password) {
        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = $_SESSION['user'];
        $stmt2 = $this->db->prepare("UPDATE customers SET lastName = :lastName,
        firstName = :firstName, extension = :extension, email = :email, 
        officeCode= :officeCode, reportsTo = :reportsTo, jobTitle = :jobTitle, 
        username = :username, password = :password WHERE username = :user");

        $stmt2->bindValue(':firstName', $lastName, PDO::PARAM_STR);
        $stmt2->bindValue(':lastName', $firstName, PDO::PARAM_STR);
        $stmt2->bindValue(':extension', $extension, PDO::PARAM_STR);
        $stmt2->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt2->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
        $stmt2->bindValue(':reportsTo', $reportsTo, PDO::PARAM_STR);
        $stmt2->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
        $stmt2->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt2->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt2->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt2->execute(); 

        // echo $user;

        return true;
    }

    // ta bort användare - Oklar.
    public function remove() {

        $user = $_SESSION['name'];

        echo "Nu tas $user bort. ";
        echo "<br>";

        

        $getId = $this->db->prepare("SELECT customerNumber FROM customers WHERE username = :user");
        $getId->execute([':user' => $user]);
        $result = ($getId->fetchColumn());

        echo "<br>";
        echo $result;
        echo "<br>";


        $stmt2 = $this->db->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber");
        $stmt2->execute([':customerNumber' => $result]); 
            

        $_SESSION = array();
        
        return true;
     
    }

    public function listCustomers() {

        $stmt2 = $this->db->prepare("SELECT customerNumber, customerName, contactFirstName, contactLastName, phone, addressLine1, addressLine2, city, state, postalCode, country FROM customers LIMIT 0, 10");
        $stmt2->execute(); 
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
        foreach($result as $col) {
            echo "<div class='itemContainer'>";
            echo "<input type='submit' name='edit' value='Edit'>";
            echo "<input type='submit' name='softDelete' value='Delete'>";
            echo '<a href="specificUser.php?customerNumber=' . $col['customerNumber'] . '> Användaren </a>';

            foreach($col as $col => $value) {   
                echo "<div class='items'> $col <br> <input value='$value' name='$col'></div>";

                // Sen någon knapp för att ta bort, samt möjlighet att ändra
            }
            echo "</div>";

        }
    }
     // IDENTISK FINNS I CUSTOMERS     
     public function editCustomer($corpName, $firstname, $lastname, $phone, $address1, 
     $address2, $city, $state, $postalcode, $country) {
         
        
        $stmt2 = $this->db->prepare("SELECT customerNumber FROM customers");
        $stmt2->execute(); 
        $customerNumber = $stmt2->fetchColumn();
             
    

         $stmt = $this->db->prepare("UPDATE customers SET customerName = :customername, contactFirstName = :contactFirstName, contactLastName = :contactLastName, phone = :phone, addressLine1 = :address1, addressLine2= :address2, city = :city, state = :state, postalCode = :postalCode, country = :country WHERE username = :user");
 
         $stmt->bindValue(':customername', $corpName, PDO::PARAM_STR);
         $stmt->bindValue(':contactLastName', $lastname, PDO::PARAM_STR);
         $stmt->bindValue(':contactFirstName', $firstname, PDO::PARAM_STR);
         $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
         $stmt->bindValue(':address1', $address1, PDO::PARAM_STR);
         $stmt->bindValue(':address2', $address2, PDO::PARAM_STR);
         $stmt->bindValue(':city', $city, PDO::PARAM_STR);
         $stmt->bindValue(':state', $state, PDO::PARAM_STR);
         $stmt->bindValue(':postalCode', $postalcode, PDO::PARAM_STR);
         $stmt->bindValue(':country', $country, PDO::PARAM_STR);
         $stmt->bindValue(':user', $customerNumber, PDO::PARAM_STR);
         $stmt->execute(); 
 
         // echo $user;
 
         return true;
     }

     


     
    // FÖR ADMIN -- Hämta vissa kolumner från (tabellen). 
    public function registerTest($table) {
        $sql = "SHOW COLUMNS FROM $table";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_NUM);
    
    foreach($result as $col) {
        // echo $col[0] . "<br>";
        if($col[0] != 'customerNumber' && $col[0] != 'creditLimit' && $col[0] != 'salesRepEmployeeNumber' && $col[0] != 'exist' && $col[0] != 'employeeNumber') {
            if($col[0] != 'password') {
            echo "<div class='col-3 input-effect'><input type='text' placeholder='$col[0]' name='$col[0]'></div>";   
            } else {
                echo "<div class='col-3 input-effect'><input type='password' placeholder='$col[0]' name='$col[0]'></div>";   

            }
            
        } 
    }
    }

    // FÖR ADMIN -- Hämta alla kolumner från (tabellen) för edit
    public function registerTest2($table) {
        $sql = "SHOW COLUMNS FROM $table";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute();
        $result = $stmt -> fetchAll(PDO::FETCH_NUM);
    
    // foreach($result as $col) {
    //     // echo $col[0] . "<br>";
    //     if($col[0] != 'password') {
    //         if($col[0] != 'password') {
    //         echo "<div class='col-3 input-effect'><input type='text' placeholder='$col[0]' name='$col[0]'></div>";   
    //         } else {
    //             echo "<div class='col-3 input-effect'><input type='password' placeholder='$col[0]' name='$col[0]'></div>";   

    //         }
            
    //     } 
    // }


    foreach($result as $col) {
        // echo $col[0] . "<br>";
        if($col[0] != 'password') {
            if($col[0] != 'password') {
            echo "<div><input type='checkbox' id='$col[0]' name='$col[0]' value='$col[0]'><label for='$col[0]'> $col[0] </label></div>";

            }
            
        } 
    }

//     <input type="checkbox" id="newsletter" name="newsletter" value="Yes" checked>
// <label for="newsletter">i want to sign up for newsletter</label>
    }
    // Skapa kund 2.0 
    public function registerCustomer2( $customerName, $contactLastName, $contactFirstName, $phone, $addressLine1, 
    $addressLine2, $city, $state, $postalCode, $country, $username, $password) {

    // Se om användaren redan finns
    $stmt3 = $this->db->prepare("SELECT * FROM classicmodels.customers WHERE username = :checkUser");
    $stmt3->execute([':checkUser' => $username]);
    $checkUsername = $stmt3->fetchColumn();
    if ($checkUsername) {
        echo "Användarnamnet används redan";
        return false;
    }   
    else {
        // Hämta det högsta Id i tabellen och lägg till 1.  
        $getId = $this->db->prepare("SELECT MAX(customerNumber) FROM customers");
        $getId->execute();
        $result = ($getId->fetchColumn() + 1);
            
        // hasha lösenordet- 
        $hash = password_hash($password, PASSWORD_DEFAULT);
        

        $stmt = $this->db->prepare("INSERT INTO classicmodels.customers (
        customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2,
        city, state, postalCode, country, username, password) 
        VALUES(:customerNumber, :customerName, :contactLastName, :contactFirstName, :phone, :addressLine1, 
        :addressLine2, :city, :state, :postalCode, :country, :username, :password)");

        

        $stmt->bindValue(':customerNumber', $result, PDO::PARAM_INT);
        $stmt->bindValue(':customerName', $customerName, PDO::PARAM_STR);
        $stmt->bindValue(':contactLastName', $contactLastName, PDO::PARAM_STR);
        $stmt->bindValue(':contactFirstName', $contactFirstName, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':addressLine1', $addressLine1, PDO::PARAM_STR);
        $stmt->bindValue(':addressLine2', $addressLine2, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt->bindValue(':postalCode', $postalCode, PDO::PARAM_STR);
        $stmt->bindValue(':country', $country, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt->execute();         

        echo "$customerName, $contactLastName, $contactFirstName, $phone, $addressLine1, 
        $addressLine2, $city, $state, $postalCode, $country, $username, $password";
        return true;   

    }
}
    // Skapa adminkonto 2.0. 
    public function registerAdmin2($lastName, $firstName, $extension, $email, $officeCode, $reportsTo,
        $jobTitle, $username, $password, $admin) {

        // Se om användaren redan finns
        $stmt3 = $this->db->prepare("SELECT * FROM classicmodels.employees WHERE username = :checkUser");
        $stmt3->execute([':checkUser' => $username]);
        $checkUsername = $stmt3->fetchColumn();
        if ($checkUsername) {
            echo "Användarnamnet används redan";
            return false;
        }   
        else {
            // Hämta det högsta Id i tabellen och lägg till 1.  
            $getId = $this->db->prepare("SELECT MAX(employeeNumber) FROM employees");
            $getId->execute();
            $result = ($getId->fetchColumn() + 1);
                
            // hasha lösenordet- 
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("INSERT INTO classicmodels.employees (employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, username, password, admin) 
            VALUES(:employeeNumber, :lastName, :firstName, :extension, :email, :officeCode, :reportsTo, :jobTitle,:username, :password, :admin)");
            // :reportsTo
    
            $stmt->bindValue(':employeeNumber', $result, PDO::PARAM_INT);
            $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':extension', $extension, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
            $stmt->bindValue(':reportsTo', $reportsTo, PDO::PARAM_INT);
            $stmt->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':admin', $admin, PDO::PARAM_INT);
            $stmt->execute(); 

            return true; 
        }
    }


    // Ändra på Admin
    function editAdmin($lastName, $firstName, $extension, $email, 
    $officeCode, $reportsTo, $jobTitle, $username, $password) {
        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = $_SESSION['user'];
        $stmt2 = $this->db->prepare("UPDATE customers SET lastName = :lastName,
        firstName = :firstName, extension = :extension, email = :email, 
        officeCode= :officeCode, reportsTo = :reportsTo, jobTitle = :jobTitle, 
        username = :username, password = :password WHERE username = :user");

        $stmt2->bindValue(':firstName', $lastName, PDO::PARAM_STR);
        $stmt2->bindValue(':lastName', $firstName, PDO::PARAM_STR);
        $stmt2->bindValue(':extension', $extension, PDO::PARAM_STR);
        $stmt2->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt2->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
        $stmt2->bindValue(':reportsTo', $reportsTo, PDO::PARAM_STR);
        $stmt2->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
        $stmt2->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt2->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt2->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt2->execute(); 

        // echo $user;

        return true;
    }

    public function editCustomer2($corpName, $firstname, $lastname, $phone, $address1, 
    $address2, $city, $state, $postalcode, $country) {
        
       
       $stmt2 = $this->db->prepare("SELECT customerNumber FROM customers");
       $stmt2->execute(); 
       $customerNumber = $stmt2->fetchColumn();
            
   

        $stmt = $this->db->prepare("UPDATE customers SET customerName = :customername, contactFirstName = :contactFirstName, contactLastName = :contactLastName, phone = :phone, addressLine1 = :address1, addressLine2= :address2, city = :city, state = :state, postalCode = :postalCode, country = :country WHERE username = :user");

        $stmt->bindValue(':customername', $corpName, PDO::PARAM_STR);
        $stmt->bindValue(':contactLastName', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':contactFirstName', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':address1', $address1, PDO::PARAM_STR);
        $stmt->bindValue(':address2', $address2, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt->bindValue(':postalCode', $postalcode, PDO::PARAM_STR);
        $stmt->bindValue(':country', $country, PDO::PARAM_STR);
        $stmt->bindValue(':user', $customerNumber, PDO::PARAM_STR);
        $stmt->execute(); 

        // echo $user;

        return true;
    }


 
    
}
