<?php

class database
{

    private $host;
    private $username;
    private $password;
    private $database;
    private $charset;

    public function __construct($host, $username, $password, $database, $charset)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->charset = $charset;

        try {
            $dsnConnection = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
            $this->db = new PDO($dsnConnection, $this->username, $this->password);


        } catch (PDOException $E) {
            die("Unable to connect: " . $E->getMessage());
        }
    }

    public function login($username, $password)
    {
        $sql = "SELECT Achternaam FROM medewerker WHERE Voornaam = :Voornaam";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['Voornaam' => $username]);

        $result = $stmt->fetch();
        $result2 = $result['Achternaam'];
        if ($password === $result2) {
            session_start();

            $_SESSION['id'] = $result['id'];
            $_SESSION['Voornaam'] = $username;
            $_SESSION['loggedin'] = true;

            header("location: welcome.php");
           

        } else {
            return false;
        }
    }

    public function sign_up($username, $firstname, $mname, $lastname, $email, $password){

        try{
             $this->db->beginTransaction();
 
             $account_id = $this->create_or_update_account(NULL, self::USER, $username, $email, $password);
             $this->create_or_update_persoon(NULL, $account_id, $firstname, $mname, $lastname);
 
             $this->db->commit();
 
             header('location: login.php');
 
             exit;
 
        }catch(Exception $e){

            $this->db->rollback();
            echo "Signup failed: " . $e->getMessage();
        }
     }

     private function create_or_update_persoon($id, $account_id, $fname, $mname, $lname){

        $sql = "INSERT INTO person VALUES (NULL, :account_id, :firstname, :middlename, :lastname, :created, :updated)";

        $statement = $this->db->prepare($sql);

        $created_at = $updated_at = date('Y-m-d H:i:s');

        $statement->execute([
            'account_id'=>$account_id, 
            'firstname'=>$fname, 
            'middlename'=>$mname, 
            'lastname'=> $lname, 
            'created'=> $created_at,
            'updated'=> $updated_at
        ]);
        
        $person_id = $this->db->lastInsertId();
        return $person_id;

    }

    private function create_or_update_account($id, $type_id, $username, $email, $password){
   
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO account VALUES (NULL, :type_id, :username, :email, :password, :created, :updated)";

        $statement = $this->db->prepare($sql);

        $created_at = $updated_at = date('Y-m-d H:i:s');

        $statement->execute([
            'type_id'=>$type_id,
            'username'=>$username, 
            'email'=>$email, 
            'password'=>$hashed_password, 
            'created'=> $created_at, 
            'updated'=> $updated_at
        ]);
        
        $account_id = $this->db->lastInsertId();
        return $account_id;

    }

    // public function koppel($naam, $activiteit, $datum, $afgerond)
    // {
    //     $sql = "INSERT INTO jongerenactiviteit VALUES (:roepnaam, :activiteit, :startdatum, :afgerond)";

    //     $statement = $this->db->prepare($sql);

    //     $statement->execute([
    //         'roepnaam' => $naam,
    //         'activiteit' => $activiteit,
    //         'startdatum' => $datum,
    //         'afgerond' => $afgerond,
    //     ]);
    // }

    // public function deleteJongeren($naam)
    // {
    //     $stmt = $this->db->prepare("DELETE FROM jongere WHERE roepnaam =:roepnaam");
    //     $stmt->bindParam(':roepnaam', $naam);
    //     $stmt->execute();
    // }

    // public function deleteActiviteit($activiteit)
    // {
    //     $stmt = $this->db->prepare("DELETE FROM activiteit WHERE activiteit =:activiteit");
    //     $stmt->bindParam(':activiteit', $activiteit);
    //     $stmt->execute();
    // }

    // public function getActiviteit($naam)
    // {
    //     $array = [];
    //     $sql = "SELECT activiteit FROM jongerenactiviteit WHERE roepnaam = :roepnaam";

    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute(['roepnaam' => $naam]);

    //     while ($result = $stmt->fetch()) {
    //         array_push($array, $result['activiteit']);
    //     }
    //     return $array;
    // }
}