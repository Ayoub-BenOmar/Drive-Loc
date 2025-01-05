<?php

require_once __DIR__ . "/../db.php";

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
            header("location: Front/Login-Register.php?error=UserNotFound");
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $user["password"]);

        if ($checkPassword == false) {
            $stmt = null;
            echo "Wrong password";
            exit();
        } 
        elseif ($checkPassword == true) {
            session_start();
            $_SESSION["userid"] = $user["idUser"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            if ($user["role"] == "admin") {
                header("location: Front/Admin-Desk.php");
            } else {
                header("location: Front/Home.php");
            }
            exit();
        }

        $stmt = null;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: Front/Login-Register.php");
        exit();
    }
    
    public function reserveCar($carId, $dateDebut, $dateFin) {
        try {
            $stmt = $this->connect()->prepare('INSERT INTO reservations (idCar, idUser, dateDebut, dateFin, statut) VALUES (?, ?, ?, ?, "en attente")');
            $stmt->execute([$carId, $_SESSION["userid"], $dateDebut, $dateFin]);

            $stmt = $this->connect()->prepare('UPDATE cars SET disponible = false WHERE idCar = ?');
            $stmt->execute([$carId]);

            return true;

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserReservations($userId) {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM reservations WHERE idUser = ?');
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

     // Accept a reservation
     public function acceptReservation($reservationId) {
        try {
            $stmt = $this->connect()->prepare('UPDATE reservations SET statut = "confirmée" WHERE idReservation = ?');
            $stmt->execute([$reservationId]);
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function denyReservation($reservationId) {
        try {
            $stmt = $this->connect()->prepare('UPDATE reservations SET statut = "annulée" WHERE idReservation = ?');
            $stmt->execute([$reservationId]);
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteReservation($reservationId) {
        try {
            $stmt = $this->connect()->prepare('DELETE FROM reservations WHERE idReservation = ?');
            $stmt->execute([$reservationId]);
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function getAllReservations() {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM reservations');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
}
?>
