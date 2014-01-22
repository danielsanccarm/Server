<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO gcm_users(name, email, gcm_regid, create_at) VALUES('$name', '$email', '$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysql_query("SELECT * FROM gcm_users WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from gcm_users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    public function AltaBus($latitud, $longitud){
        //$result =mysql_query("Insert INTO Unidades(Latitud, Longitud) values('$latitud','$longitud')");
        //$id = mysql_insert_id(); // last inserted id
        $result= mysql_query("UPDATE Unidades set Latitud='$latitud', Longitud='$longitud' where id_Unidad=2");
        //$result= mysql_query("Insert INTO Unidades (id_Unidad,Latitud, Longitud) values('$id','$latitud','$longitud') on duplicate key update Latitud='$latitud', Longitud='$longitud';");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM Unidades WHERE id_Unidad = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function MostrarBus(){
           $result = mysql_query("Select * from Unidades");
           return $result;

    }
    
    public function AnalisisPeriferias(){
           $result = mysql_query("Select ID_Periferia, Latitud_P, Longitud_P from Periferia where ID_Estacion='1'");
           return $result;
    }
    
    public function GCM_IDS_Estacion(){
           $gcm_ids=mysql_query("Select gcm_regid from gcm_users, UserStUnit, Estaciones where gcm_users.id= UserStUnit.ID_User and UserStUnit.ID_Estacion = Estaciones.ID_Estacion;");
           return $gcm_ids;
    }

}


?>
