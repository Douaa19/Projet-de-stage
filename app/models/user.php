<?php

class user

{
    private $database;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Get All From Area Table
    public function getArea() {
        $this->db->query("SELECT * FROM area");

        $areas = $this->db->resultSet();
        // Check If The Result Is True Or False
        if ($areas) {
            return $areas;
        } else {
            return false;
        }
    }


    // Get All From Cities Table
    public function getCities() {
        $this->db->query("SELECT * FROM cities");

        $cities = $this->db->resultSet();
        // Check If The Result Is True Or False
        if ($cities) {
            return $cities;
        }else {
            return false;
        }
    }


    // Get One area
    public function getOneArea($data) {
        $this->db->query("SELECT * FROM area WHERE name_area = :activity");

        $this->db->bind(':activity', $data['activity']);

        $data = $this->db->single();
        if ($data) {
            return $data;
        }else {
            return false;
        }
    }


    // // Get One City
    public function getCity($data) {
        $this->db->query("SELECT * FROM cities WHERE name_city = :city");

        $this->db->bind(':city', $data['city']);

        $data = $this->db->single();
        if ($data) {
            return $data;
        }else {
            return false;
        }
    }


    // Add New User
    public function addUser($data) {
        $area = $this->getOneArea($data);
        $city = $this->getCity($data);
        // var_dump($area, $city);
        // die();

        if ($area && $city) {
            $this->db->query("INSERT INTO `users`(`civility`, `lName`, `fName`, `id_area`, `date_birth`, `email`, `phone`, `zip_code`, `address`, `country`, `id_city`, `name_file`) VALUES (:sexe, :lName, :fName, :activity, :date_birth, :email, :phone, :zip_code, :address, :country, :city, :name_file)");

            // Binding Data
            $this->db->bind(':sexe', $data['sexe']);
            $this->db->bind(':lName', $data['lName']);
            $this->db->bind(':fName', $data['fName']);
            $this->db->bind(':activity', $area->id_area);
            $this->db->bind(':date_birth', $data['date_birth']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':zip_code', $data['zip_code']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':country', $data['country']);
            $this->db->bind(':city', $city->id_city);
            $this->db->bind(':name_file', $data['name_file']);

            $result = $this->db->execute();
            if ($result) {
                return true;
                die();
            }else {
                return false;
                die();
            }
        }
    }


    // Get Some Infos For Check If The User Is Allredy Exists
    public function getUser($data) {
        $this->db->query("SELECT * FROM users WHERE email = :email AND fName = :fName AND lName = :lName");

        $this->db->bind(':email', $data['email']);
        $this->db->bind(':fName', $data['fName']);
        $this->db->bind(':lName', $data['lName']);

        $data = $this->db->single();
        if ($data) {
            return $data;
        }else {
            return false;
        }
    }


    // Add Diploma Into Database
    public function addDiploma($data) {
        $this->db->query("INSERT INTO `diplomas`(`name_diploma`, `level`, `date_diploma`, `etablissement`, `subject`, `id_user`) VALUES (:name_diploma, :level, :date_diploma, :etablissement, :subject, :id_user)");

        // Binding Data
        $this->db->bind(':name_diploma', $data['name_diploma']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':date_diploma', $data['date_diploma']);
        $this->db->bind(':etablissement', $data['etablissement']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':id_user', $data['id_user']);

        $result = $this->db->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    // Get All Diplomas
    public function getDiplomas($data) {
        print_r($data);
    }
}
