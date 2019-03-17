<?php 

trait Userfunctions {
    
    function checkUsername($username) {
        $sql = "SELECT * FROM $this->dbTable WHERE username = :checkUser";
        $userExist = $this->db->prepare($sql);
        $userExist->execute([':checkUser' => $username]);
        $checkUsername = $userExist->fetchColumn();
        if($checkUsername) {
            echo "Användarnamnet upptaget!";
            return false;
        }   
        else {
            return true;
        }
    }

    // function newId($dbTable) {           
    //     $getId = $this->db->prepare("SELECT MAX(customerNumber) FROM $dbTable");
    //     $getId->execute();
    //     $newId = ($getId->fetchColumn() + 1);
    //     return $newId;
    // }


    public function login($user, $pass) {
        
        // Hämta lösenordet koppålat till användarnamnet, från angiven tabell. 
        $sql = "SELECT password FROM $this->dbTable WHERE username = :user";
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
        return $this->is_logged_in; 
    }


        
}