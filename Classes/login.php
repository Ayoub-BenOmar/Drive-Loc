<?php

class login extends database {
    
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
            // echo"naja7t";
            header("location: index.php?error=none");
            exit();
        }

        $stmt = null;
    }
}