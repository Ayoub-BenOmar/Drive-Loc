<?php
require_once './Classes/login.php';
class loginContr extends login{

    protected $email;
    protected $password;

    public function __construct($email, $password){

        $this->email = $email;
        $this->password = $password;

    }

    public function loginUser(){
        if ($this->emptyInputs() == false) {
            echo "Empty inputs";
            exit;
        }

        if ($this->invalidEmail() == false) {
            echo "Inavlid email";
            exit;
        }

        $this->getUser($this->email,  $this->password);
        echo "Login successfully";

        header("location: index.php");
    }

    private function emptyInputs(){
        $result = false;
        if (empty($this->email) || empty($this->password)) {
            $result = false;
        } 
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } 
        else {
            $result = true;
        }
        return $result;
    }
}