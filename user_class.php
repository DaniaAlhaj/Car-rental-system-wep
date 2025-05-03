<?php

class User {
    private $userid;
    private $name;
    private $flat;
    private $street;
    private $city;
    private $country;
    private $dateofBirth;
    private $idnumber;
    private $card_number;
    private $phone;
    private $expiry_date;
    private $card_name;
    private $bank_name;
    private $username;
    private $user_password;
    private $confirm_user_password;
    private $email;
    public function __construct() {
        $this->userid = '';
        $this->name = '';
        $this->flat = '';
        $this->street = '';
        $this->city = '';
        $this->country = '';
        $this->dateofBirth = '';
        $this->idnumber = '';
        $this->card_number = '';
        $this->phone = '';
        $this->expiry_date = '';
        $this->card_name = '';
        $this->bank_name = '';
        $this->username = '';
        $this->email = '';
       
        
        $this->confirm_user_password = '';
    }


    public function getconfirm_user_password() {
        return $this->confirm_user_password;
    }

    public function setconfirm_user_password($confirm_user_password) {
        $this->confirm_user_password = $confirm_user_password;
    }





    public function getUserId() {
        return $this->userid;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setUserId($userid) {
        $this->userid = $userid;
    }
    // Getter and Setter for name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getter and Setter for flat
    public function getFlat() {
        return $this->flat;
    }

    public function setFlat($flat) {
        $this->flat = $flat;
    }

    // Getter and Setter for street
    public function getStreet() {
        return $this->street;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    // Getter and Setter for city
    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    // Getter and Setter for country
    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    // Getter and Setter for dateofBirth
    public function getDateofBirth() {
        return $this->dateofBirth;
    }

    public function setDateofBirth($dateofBirth) {
        $this->dateofBirth = $dateofBirth;
    }

    // Getter and Setter for idnumber
    public function getIdNumber() {
        return $this->idnumber;
    }

    public function setIdNumber($idnumber) {
        $this->idnumber = $idnumber;
    }

    // Getter and Setter for card_number
    public function getCardNumber() {
        return $this->card_number;
    }

    public function setCardNumber($card_number) {
        $this->card_number = $card_number;
    }

    // Getter and Setter for phone
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    // Getter and Setter for expiry_date
    public function getExpiryDate() {
        return $this->expiry_date;
    }

    public function setExpiryDate($expiry_date) {
        $this->expiry_date = $expiry_date;
    }

    // Getter and Setter for card_name
    public function getCardName() {
        return $this->card_name;
    }

    public function setCardName($card_name) {
        $this->card_name = $card_name;
    }

    // Getter and Setter for bank_name
    public function getBankName() {
        return $this->bank_name;
    }

    public function setBankName($bank_name) {
        $this->bank_name = $bank_name;
    }

    // Getter and Setter for username
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter and Setter for user_password
    public function getUserPassword() {
        return $this->user_password;
    }

    public function setUserPassword($user_password) {
        $this->user_password = $user_password;
    }
}
?>
