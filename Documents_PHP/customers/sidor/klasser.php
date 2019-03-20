<?php
    require_once "dbklass.php";


//----------------------------Klass för products------------------------------------------------------------------------------

class Product extends Db {
    public $productCode;
    public $productName;
    public $productLine;
    public $productScale;
    public $productVendor;
    public $productDescription;
    public $quantityInStock;
    public $buyPrice;
    public $MSRP;
 
    //i konstruktor, om ingen produktkod anges, skapa produktkod genom att hämta högsta värdet från classicModels och sedan +1
    function __construct($productCode = ""){

        if($productCode == "") {
            $db = new Db;
            $pdo = $db->connect();
            $getMaxID = $pdo->prepare("SELECT MAX(productCode) FROM products");
            $getMaxID->execute();
            $result = ($getMaxID->fetchColumn(0));      
            $this->productCode = substr($result, 0, 4).((int)substr($result, 4) + 1);
        } else {
            $this->productCode = $productCode;
        }
    }
    
    //skapa produkt, ta in alla parametrar insert into via prepared statement, execute. Funkar ej av någon anledning?
    public function createProduct($productCode, $productName, $productLine, $productScale, $productVendor, $productDescription, $quantityInStock, 
        $buyPrice, $MSRP) { 
        $this->productName = $productName;
        $this->productLine = $productLine;
        $this->productScale = $productScale;
        $this->productVendor = $productVendor;
        $this->productDescription = $productDescription;
        $this->quantityInStock = $quantityInStock;
        $this->buyPrice = $buyPrice;
        $this->MSRP = $MSRP; 
        $this->productCode = $productCode;

        $db = new Db;
        $pdo = $db->connect();

        $stmt = $pdo->prepare("INSERT INTO classicmodels.products (productCode, productName, productLine, productScale, productVendor,
         productDescription, quantityInStock, buyPrice, MSRP) 
        VALUES(:productCode, :productName, :productLine, :productScale, :productVendor, :productDescription, :quantityInStock, :buyPrice, :MSRP)");
        
        $stmt->bindValue(':productCode', $productCode, PDO::PARAM_STR);
        $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
        $stmt->bindValue(':productLine', $productLine, PDO::PARAM_STR);
        $stmt->bindValue(':productScale', $productScale, PDO::PARAM_STR);
        $stmt->bindValue(':productVendor', $productVendor, PDO::PARAM_STR);
        $stmt->bindValue(':productDescription', $productDescription, PDO::PARAM_STR);
        $stmt->bindValue(':quantityInStock', $quantityInStock, PDO::PARAM_INT);
        $stmt->bindValue(':buyPrice', $buyPrice, PDO::PARAM_INT);
        $stmt->bindValue(':MSRP', $MSRP, PDO::PARAM_INT);

    }

    public function getAllProducts() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products";

        $getAllProducts =$pdo->prepare($sql);
        $getAllProducts->execute();

        return $getAllProducts;
    }

    public function getProduct() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products WHERE productCode = '" . $this->productCode . "'";

        $getProduct = $pdo->prepare($sql); 
        $getProduct->execute();
        
        $rows = $getProduct->fetchAll(PDO::FETCH_ASSOC);

        $this->productName = $rows[0]["productName"];
        $this->productLine = $rows[0]["productLine"];
        $this->productScale = $rows[0]["productScale"];
        $this->productVendor = $rows[0]["productVendor"];
        $this->productDescription = $rows[0]["productDescription"];
        $this->quantityInStock = $rows[0]["quantityInStock"];
        $this->buyPrice = $rows[0]["buyPrice"];
        $this->MSRP = $rows[0]["MSRP"];
    }

    //ej klar
    public function updateProduct($productName, $productDescription, $MSRP, $productVendor) {
        $this->productName = $productName;
        $this->productDescription =$productDescription;
        $this->MSRP = $MSRP;
        $this->productVendor = $productVendor;

        $db = new Db;
        $pdo = $db->connect();

        $sql = "UPDATE products SET productName ='" . $productName . "', productDescription = '" . $productDescription . "', 
        MSRP = '" . $MSRP . "', productVendor ='" . $productVendor . "' WHERE productCode = '" . $this->productCode. "'";
        $stmt = $pdo->prepare($sql); // prepare the pdo
        $stmt->execute(); // execute does the actual update


        // $stmt = $pdo->prepare("UPDATE products SET productName = :productName, productDescription = :productDescription, 
        // MSRP = :MSRP, productVendor = :productVendor WHERE productCode = :productNumber ");

        // $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
        // $stmt->bindValue(':productDescription', $productDescription, PDO::PARAM_STR);
        // $stmt->bindValue(':MSRP', $MSRP, PDO::PARAM_STR);
        // $stmt->bindValue(':productVendor', $productVendor, PDO::PARAM_STR);
        // $stmt->bindValue(':productNumber', $this->productCode, PDO::PARAM_STR);
        // $stmt->execute();
     
    }
    //ta bort produkt. Ej klar, tanken är drop-down med available/unavailable samt ny kolumn i db med samma värden.
    public function deleteProduct() {
        $db = new Db;
        $pdo = $db->connect();

        $stmt = $pdo->prepare("DELETE FROM products WHERE productCode = :productCode;");
        $stmt->execute([':productCode' => $productCode]);
    }

    public function getProductsInLine() {
        $db = new Db;
        $pdo = $db->connect();

        $stmt = $pdo->prepare("SELECT * FROM products WHERE productLine = :productLine;");
        $stmt->execute([':productLine' => $productLine]);

    }

    //bör ligga i klassen productLines, men blir catch 22 situation att ange productLine som startvärde när en vill hämta productLines
    //(se constructor för productLines)
    
    public function getProductLines() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT productLine FROM productLines";

        $getProductLines = $pdo->prepare($sql);
        $getProductLines->execute();

        return $getProductLines;

    }

}

//---------------------------------------Klass för productLines---------------------------------------------------------

    class ProductLines extends Db {
        public $productLine;
        public $textDescription;
        public $htmlDescription;
        public $image;

    function __construct ($productLine) {
        
        $this->productLine = $productLine;
        $db = new Db;
        $pdo = $db->connect();

    }

    //Hämtar allt från en specificerad productLine
    public function getProductLine() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM productlines WHERE productLine = '" . $this->productLine . "'";

        $getProductLine = $pdo->prepare($sql); 
        $getProductLine->execute();
        
        $rows = $getProductLine->fetchAll(PDO::FETCH_ASSOC);

        $this->productLine = $rows[0]["productLine"];
        $this->textDescription = $rows[0]["textDescription"];
        $this->htmlDescription = $rows[0]["htmlDescription"];
        $this->image = $rows[0]["image"];

    }

    public function getProductLineName() {
        $db = new Db;
        $pdo = $db->connect();
        
        $sql = "SELECT productLine FROM productlines";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute();

    }
    //Finns ej funktionalitet på sidan ännu

    public function createProductLine($productLine, $textDescription = null, $htmlDescription = null, $image = null) {
        $this->productLine = $productLine;
        $this->textDescription = $htmlDescription;
        $this->htmlDescription = $htmlDescription;
        $this->image = $image;

        $db = new Db;
        $pdo = $db->connect();

        $sql = "INSERT INTO productlines SET productLine ='" . $this->productLine . "', textDescription ='" . 
        $textDescription . "', htmlDescription ='" . $htmlDescription . "', image ='" . $image . "'";

        $stmt = $pdo->prepare($sql); 
        $stmt->execute();
    }

    //hämtar alla produkter i en viss kategori
    public function getProductsInLine() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

        $getProductsInLine = $pdo->prepare($sql);
        $getProductsInLine->execute();

        return $getProductsInLine;

        
    }

    //Hämtar alla kategorier från productLines
    public function getProductLines() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT productLine from productLines";

        $getproductLines = $pdo->prepare($sql);
        $getProductLines->execute();

        return $getProductLines; 
    }

} 

//---------------------------------AXELS INCLUDES TILL ADMIN----------------------------------------

// Admin 2.0
// include 'generic/db.php';
// class Admin {
//     private $db;
//     public $is_logged_in = false;
//     public function __construct() {
//         // Skapar en ny instans av DB, och sparar den i vårt privata $db. 
//         $obj = new DB();
//         $this->db = $obj->pdo;
        
//     }
//       // Inloggning.   
//       public function login($user, $pass) {
        
//         // Hämta lösenordet koppålat till användarnamnet. 
//         $sql = "SELECT password FROM employees WHERE username = :user";
//         $stmt = $this->db->prepare($sql);
//         $stmt->execute([':user' => $user]); 
//         // Fetchcolumn hämtar ett värde istället för en array i en array. 
//         $hash = $stmt->fetchColumn();
//         // Verfifiera att lösenordet stämmer överens med hash.
//         $this->is_logged_in = password_verify($pass, $hash);
//         if($this->is_logged_in) {
//             $sql2 = "SELECT employeeNumber FROM employees WHERE username = :user";
//             $stmt2 = $this->db->prepare($sql2);
//             $stmt2->execute([':user' => $user]); 
//             $right = $stmt2->fetchColumn();
//             $_SESSION['userId'] = $right;
//             $_SESSION['logged_in'] = true;
//             $_SESSION['user'] = "$user";
//             foreach($_SESSION as $key => $value) {
//                 echo "Sessionvärde: $key : $value <br>";
//             }
//             // $_SESSION['adminRight'] = "$right";
//         }
//         var_dump($this->is_logged_in);  
//         return $this->is_logged_in; 
//     }
//     // Skapa adminkonto Annan sql, annars samma. 
//     public function registerAdmin($lastName, $firstName, $extension, $email, $officeCode, $reportsTo,
//         $jobTitle, $username, $password, $admin) {
//         // Se om användaren redan finns
//         $stmt3 = $this->db->prepare("SELECT * FROM classicmodels.employees WHERE username = :checkUser");
//         $stmt3->execute([':checkUser' => $username]);
//         $checkUsername = $stmt3->fetchColumn();
//         if ($checkUsername) {
//             echo "Användarnamnet används redan";
//             return false;
//         }   
//         else {
//             // Hämta det högsta Id i tabellen och lägg till 1.  
//             $getId = $this->db->prepare("SELECT MAX(employeeNumber) FROM employees");
//             $getId->execute();
//             $result = ($getId->fetchColumn() + 1);
                
//             // hasha lösenordet- 
//             $hash = password_hash($password, PASSWORD_DEFAULT);
            
//             $stmt = $this->db->prepare("INSERT INTO classicmodels.employees (employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, username, password, admin) 
//             VALUES(:employeeNumber, :lastName, :firstName, :extension, :email, :officeCode, :reportsTo, :jobTitle,:username, :password, :admin)");
//             // :reportsTo
    
//             $stmt->bindValue(':employeeNumber', $result, PDO::PARAM_INT);
//             $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
//             $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
//             $stmt->bindValue(':extension', $extension, PDO::PARAM_STR);
//             $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//             $stmt->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
//             $stmt->bindValue(':reportsTo', $reportsTo, PDO::PARAM_INT);
//             $stmt->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
//             $stmt->bindValue(':username', $username, PDO::PARAM_STR);
//             $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
//             $stmt->bindValue(':admin', $admin, PDO::PARAM_INT);
//             $stmt->execute(); 
//             return true; 
//         }
//     }
//     // se användaruppgifter.  Annan sql, annars samma. 
//     public function view() {
//         $user = $_SESSION['user'];
        
//         $stmt2 = $this->db->prepare("SELECT lastName, firstName, extension, email, officeCode, reportsTo, jobTitle, username FROM employees WHERE username = :user");
//         $stmt2->execute([':user' => $user]); 
//         $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
//         foreach($result as $col) {
//             foreach($col as $col => $value) {   
//                 echo "<pre>";
//                 echo "$col <br> <input value='$value' name='$col'>";   
//                 echo "</pre>";            
//             }
//         }
//     }
//     // Ändra användaruppgifter - oklar.
//     function editUser($lastName, $firstName, $extension, $email, 
//     $officeCode, $reportsTo, $jobTitle, $username, $password) {
        
//         $hash = password_hash($password, PASSWORD_DEFAULT);
//         $user = $_SESSION['user'];
//         $stmt2 = $this->db->prepare("UPDATE customers SET lastName = :lastName,
//         firstName = :firstName, extension = :extension, email = :email, 
//         officeCode= :officeCode, reportsTo = :reportsTo, jobTitle = :jobTitle, 
//         username = :username, password = :password WHERE username = :user");
//         $stmt2->bindValue(':firstName', $lastName, PDO::PARAM_STR);
//         $stmt2->bindValue(':lastName', $firstName, PDO::PARAM_STR);
//         $stmt2->bindValue(':extension', $extension, PDO::PARAM_STR);
//         $stmt2->bindValue(':email', $email, PDO::PARAM_STR);
//         $stmt2->bindValue(':officeCode', $officeCode, PDO::PARAM_STR);
//         $stmt2->bindValue(':reportsTo', $reportsTo, PDO::PARAM_STR);
//         $stmt2->bindValue(':jobTitle', $jobTitle, PDO::PARAM_STR);
//         $stmt2->bindValue(':username', $username, PDO::PARAM_STR);
//         $stmt2->bindValue(':password', $hash, PDO::PARAM_STR);
//         $stmt2->bindValue(':user', $user, PDO::PARAM_STR);
//         $stmt2->execute(); 
//         // echo $user;
//         return true;
//     }
//     // ta bort användare - Oklar.
//     public function remove() {
//         $user = $_SESSION['name'];
//         echo "Nu tas $user bort. ";
//         echo "<br>";
        
//         $getId = $this->db->prepare("SELECT customerNumber FROM customers WHERE username = :user");
//         $getId->execute([':user' => $user]);
//         $result = ($getId->fetchColumn());
//         echo "<br>";
//         echo $result;
//         echo "<br>";
//         $stmt2 = $this->db->prepare("DELETE FROM customers WHERE customerNumber = :customerNumber");
//         $stmt2->execute([':customerNumber' => $result]); 
            
//         $_SESSION = array();
        
//         return true;
     
//     }
//     public function listCustomers() {
//         $stmt2 = $this->db->prepare("SELECT customerName, contactFirstName, contactLastName, phone, addressLine1, addressLine2, city, state, postalCode, country FROM customers LIMIT 0, 10");
//         $stmt2->execute(); 
//         $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);     
    
//         foreach($result as $col) {
//             echo "<div class='itemContainer'>";
//             foreach($col as $col => $value) {   
//                 echo "<div class='items'> $col <br> <input value='$value' name='$col'></div>";
//                 // Sen någon knapp för att ta bort, samt möjlighet att ändra
//             }
//             echo "</div>";
//         }
//     }
    
// }


?>
