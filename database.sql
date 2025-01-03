CREATE DATABASE location_voitures;
USE location_voitures;

CREATE TABLE users (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client',
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cars (
    idCar INT AUTO_INCREMENT PRIMARY KEY,
    categoryId INT,
    model VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    disponible BOOLEAN NOT NULL DEFAULT TRUE;
    FOREIGN KEY (categoryId) REFERENCES category(categoryId) ON DELETE CASCADE
);

CREATE TABLE category (
    categoryId INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL
);

CREATE TABLE reservations (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    idCar INT,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    Place VARCHAR(100) NOT NULL,
    statut ENUM('en attente', 'confirmée', 'annulée') DEFAULT 'en attente',
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES users(idUser),
    FOREIGN KEY (idCar) REFERENCES cars(idCar)
    ON DELETE CASCADE
);

CREATE TABLE avis (
    idAvis INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    idCar INT,
    comment TEXT NOT NULL,
    visible BOOLEAN DEFAULT TRUE, -- Soft delete
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES users(idUser),
    FOREIGN KEY (idCar) REFERENCES cars(idCar)
    ON DELETE CASCADE
);