<?php

class user extends database{

    protected function setUser($nom, $email, $password){
        $stmt = $this->connect()->prepare('INSERT INTO users(nom, email, password) VALUES (?, ?, ?);');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($nom, $email, $hashedPassword))) {
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = NULL;
    }

    protected function checkEmail($email){
        $stmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function getUser($email, $password) {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            echo "Statment failed";
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            echo "User not found";
            exit();
        }

        $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $hashedPassword[0]["password"]);

        if ($checkPassword == false) {
            $stmt = null;
            echo "Wrong password";
            exit();
        } 
        elseif ($checkPassword == true) {

            session_start();
            $_SESSION["userid"] = $hashedPassword[0]["idUser"];
            $_SESSION["email"] = $hashedPassword[0]["email"];
            echo"naja7t";
            // header("location: index.php?error=none");
            exit();
        }

        $stmt = null;
    }
}