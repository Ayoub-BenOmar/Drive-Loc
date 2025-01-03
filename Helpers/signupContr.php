<?php
require_once './Classes/user.php';
class signupContr extends user{

    protected $nom;
    protected $email;
    protected $password;

    public function __construct($nom, $email, $password){
        
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;

    }

    public function signupUser(){
        if ($this->emptyInputs() == false) {
            echo "Empty inputs";
            exit;
        } 

        if ($this->invalidEmail() == false) {
            echo "Inavlid email";
            exit;
        } 

        if ($this->emailTakenCheck() == false) {
            echo "Email taken";
            exit();
        } 

        $this->setUser($this->nom,  $this->email,  $this->password);
    }

    private function emptyInputs(){
        $result = false;
        if (empty($this->nom) || empty($this->email) || empty($this->password)) {
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

    private function emailTakenCheck(){
        $result = false;
        if (!$this->checkEmail($this->email)) {
            $result = false;
        } 
        else {
            $result = true;
        }
        return $result;
    }
}