<?php

// user 2.0
include 'generic/db.php';
class Customers  {

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

        $sql = "SELECT password FROM customers WHERE username = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $user]); 
        // Fetchcolumn hämtar ett värde istället för en array i en array. 
        $hash = $stmt->fetchColumn();

        $this->is_logged_in = password_verify($pass, $hash);

        if($this->is_logged_in) {
            $_SESSION['logged_in'] = true;
            $_SESSION['name'] = "$user";
            $_SESSION['shoesize'] = '43';
        }
        var_dump($this->is_logged_in);  
        return $this->is_logged_in; 
    }

    // Skapa kundkonto
    public function register($username, $corpName, $firstname, $lastname, $phone, $address1, 
    $address2, $city, $state, $postalcode, $country, $password) {

        // Se om användarnamn redan finns -- Gör denna så vi kan kalla den från flera olika? kolumn som inparameter?
        // Kan kalla på denna, som, om sann, skickar vidare till nästa funktion. 
        $stmt3 = $this->db->prepare("SELECT * FROM customers WHERE username = :checkUser");
        $stmt3->execute([':checkUser' => $username]);
        $checkUsername = $stmt3->fetchColumn();
        if ($checkUsername) {
            echo "Användarnamnet används redan";
            return false;
        }   
        else {            
            // Hämta det högsta Id i tabellen och lägg till 1. Gör denna så vi kan kalla den från flera olika? kolumn som inparameter?
            $getId = $this->db->prepare("SELECT MAX(customerNumber) FROM customers");
            $getId->execute();
            $result = ($getId->fetchColumn() + 1);
            
            // Hasha lösenordet
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
 
  
    // se användaruppgifter. 
    public function view() {
        $user = $_SESSION['name'];
        
        $stmt2 = $this->db->prepare("SELECT customerName, contactFirstName, contactLastName, phone, addressLine1, addressLine2, city, state, postalCode, country FROM customers WHERE username = :user");
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

    // Ändra användaruppgifter  - borde kunna ändra med det värdet det har. Kan ändra värdet de har med input?     
    public function editUser($corpName, $firstname, $lastname, $phone, $address1, 
    $address2, $city, $state, $postalcode, $country) {
        
        $user = $_SESSION['name'];
        $stmt2 = $this->db->prepare("UPDATE customers SET customerName = :customername, contactFirstName = :contactFirstName, contactLastName = :contactLastName, phone = :phone, addressLine1 = :address1, addressLine2= :address2, city = :city, state = :state, postalCode = :postalCode, country = :country WHERE username = :user");

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
        $stmt2->execute(); 

        // echo $user;

        return true;
    }

    // ta bort användare
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

