<?php

/*
 * Tutorial: PHP Login Registration system
 *
 * Page: Application library
 * */

class Library
{

 /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */
    public function Login($username, $password)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT user_id FROM tbl_user WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha1', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->user_id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function GetUserDetails($user_id){
        try{


            $db = DB();
            $query = $db->prepare("SELECT user_id, username, last_name, first_name, middle_name, email FROM tbl_user WHERE user_id=:user_id");
            $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0){
                return $query->fetch(PDO::FETCH_OBJ);
            }
            

        } catch (PDOException $e){
            exit($e->getMessage);
        }
    } // End of function GetUserDetails


     public function GetWardDetails(){
        try{


            $db = DB();
            $query = $db->prepare("SELECT wardcode,wardname FROM hward ORDER BY wardname ASC");
            $query->execute();

            if ($query->rowCount() > 0){
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            

        } catch (PDOException $e){
            exit($e->getMessage);
        }
    } // End of function GetUserDetails



    } // End of class Library

 ?>