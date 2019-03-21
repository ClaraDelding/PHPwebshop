<?php

// user 2.0
<<<<<<< HEAD
include '../../genericInclude/classes/db.php';
=======
include_once '../../genericInclude/classes/db.php';
>>>>>>> origin/ClarasFrånAxelsDevBranch
class Customers  {

    private $db;
    public $is_logged_in = false;

    public function __construct() {
        // Lagrar anslutning till databasen. 
        $obj = new DB();
        $this->db = $obj->pdo;
    }

    // Inloggning. 
    public function login($user, $pass) {
        
        // Hämtar lösenord som överenstämmer med användaren om användaren inte har tagits bort soft
        $sql = "SELECT password FROM customers WHERE username = :user AND exist = 'yes'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $user]); 

        // Hash är då det lösenord som vi hämtat från DB. Det är hashat. 
        $hash = $stmt->fetchColumn();

        // verifierar att lösenordet matcher hashat lösen i DB. 
        $this->is_logged_in = password_verify($pass, $hash);

        if($this->is_logged_in) {
            $_SESSION['logged_in'] = true;
            $_SESSION['name'] = "$user";
        }
        return $this->is_logged_in; 
    }

    // Skapa kundkonto
    public function register($username, $corpName, $firstname, $lastname, $phone, $address1, 
    $address2, $city, $state, $postalcode, $country, $password) {

        // Här ser vi om användarnamnet redan används. 
        $stmt3 = $this->db->prepare("SELECT * FROM customers WHERE username = :checkUser");
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
            
            // Här hashar vi lösenordet. 
            $hash = password_hash($password, PASSWORD_DEFAULT);
        
            // Skapa ny användare med given data.
            $stmt = $this->db->prepare("INSERT INTO customers (customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, username, password) 
            VALUES(:customerNumber, :customername, :contactLastName, :contactFirstName, :phone, :address1, :address2, :city, :state, :postalCode, :country, :username, :password)");

            $stmt->bindValue(':customerNumber', $result, PDO::PARAM_INT);
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
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->execute();         

            return true; 
        }
    }
    
 
  
    // Sätter in användaruppgfiter i Inputs så att vi kan göra ändringar och skicka in de. 
    public function view() {
        
        $user = $_SESSION['name'];
        
        $stmt2 = $this->db->prepare("SELECT customerName, contactFirstName, contactLastName, phone, addressLine1, addressLine2, city, state, postalCode, country, password FROM customers WHERE username = :user");
        $stmt2->execute([':user' => $user]); 
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
        foreach($result as $col) {
            foreach($col as $col => $value) {   

                if($col == 'password') {
                    echo "$col <br><div class='col-3 input-effect'> <input type='password' value='' name='$col'></div>";   

                } else {
                echo "$col <br><div class='col-3 input-effect'> <input class='effect-19' type='text' value='$value' name='$col'></div>";   
                }
            }
        }
    }

    // Ändra användaruppgifter  -      
    public function editUser($corpName, $firstname, $lastname, $phone, $address1, 
    $address2, $city, $state, $postalcode, $country, $password) {
        $user = $_SESSION['name'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt2 = $this->db->prepare("UPDATE customers SET customerName = :customername, contactFirstName = :contactFirstName, contactLastName = :contactLastName, phone = :phone, addressLine1 = :address1, addressLine2= :address2, city = :city, state = :state, postalCode = :postalCode, country = :country, password = :pass WHERE username = :user");

        $stmt2->bindValue(':customername', $corpName, PDO::PARAM_STR);
        $stmt2->bindValue(':contactLastName', $lastname, PDO::PARAM_STR);
        $stmt2->bindValue(':contactFirstName', $firstname, PDO::PARAM_STR);
        $stmt2->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt2->bindValue(':address1', $address1, PDO::PARAM_STR);
        $stmt2->bindValue(':address2', $address2, PDO::PARAM_STR);
        $stmt2->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt2->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt2->bindValue(':postalCode', $postalcode, PDO::PARAM_STR);
        $stmt2->bindValue(':country', $country, PDO::PARAM_STR);
        $stmt2->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt2->bindValue(':pass', $hash, PDO::PARAM_STR);

        $stmt2->execute(); 

        return true;
    }

        // Om användaren tar bort sitt konto så tar vi bort känslig information, samt säger att användaren inte längre existerar. vi tar inte bort användaren.      
        public function softDelete() {

            $user = $_SESSION['name'];
            $softDelete = 'Soft Delete';
        
    
            $stmt2 = $this->db->prepare("UPDATE customers SET contactFirstName = :contactFirstName, contactLastName = :contactLastName, phone = :phone, addressLine1 = :address1, addressLine2= :address2, username = :username, password = :pass, exist = :exist WHERE username = :user");
    
            $stmt2->bindValue(':contactLastName', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':contactFirstName', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':phone', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':address1', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':address2', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':username', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':pass', $softDelete, PDO::PARAM_STR);
            $stmt2->bindValue(':exist', 'not', PDO::PARAM_STR);

            $stmt2->bindValue(':user', $user, PDO::PARAM_STR);

    
            $stmt2->execute(); 

            $_SESSION = array();

            return true;
        }

    // ta bort användare helt och hållet. Kommer ej användas. 
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



}

