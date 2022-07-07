<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/utils/random.php");

class User
{
    public string $id;
    public string $name;
    public string $username;
    public string $password;
    public string $phone;
    public string $birthdate;
    public string $gender;

    public function __construct($firstName, $lastName, $username, $password, $phoneNumber, $birthdateday, $birthdatemonth, $birthdateyear, $gender)
    {
        $birthdate = date_create($birthdateyear . "-" . $birthdatemonth . "-" . $birthdateday, timezone_open("Asia/Jakarta"));
        if ($phoneNumber[0] == '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }

        $this->id = strval(generateRandomString());
        $this->name = ucfirst($firstName) . " " . ucfirst($lastName);
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->phone = "62" . $phoneNumber;
        $this->birthdate = date_format($birthdate, "Y-m-d");
        $this->gender = $gender;
    }
}