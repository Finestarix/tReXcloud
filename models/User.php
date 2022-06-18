<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/random.php");

class User
{
    public $id;
    public $name;
    public $username;
    public $password;
    public $phone;
    public $birthdate;
    public $gender;

    public function __construct($firstName, $lastName, $username, $password, $phoneNumber, $birthdateday, $birthdatemonth, $birthdateyear, $gender)
    {
        $birthdate = date_create($birthdateyear . "-" . $birthdatemonth . "-" . $birthdateday, timezone_open("Asia/Jakarta"));
        if ($phoneNumber[0] == '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }

        $this->id = strval(generateID());
        $this->name = ucfirst($firstName) . " " . ucfirst($lastName);
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->phone = "62" . $phoneNumber;
        $this->birthdate = date_format($birthdate, "Y-m-d");
        $this->gender = $gender;
    }
}