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
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    disponible BOOLEAN NOT NULL DEFAULT TRUE,
    image VARCHAR(255),
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

CREATE TABLE themes (
    idTheme INT AUTO_INCREMENT PRIMARY KEY,
    themeName VARCHAR(100) NOT NULL,
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    idArticle INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    idTheme INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    video VARCHAR(255),
    approved BOOLEAN DEFAULT FALSE,
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES users(idUser),
    FOREIGN KEY (idTheme) REFERENCES themes(idTheme) ON DELETE CASCADE
);

CREATE TABLE tags (
    idTag INT AUTO_INCREMENT PRIMARY KEY,
    tagName VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE article_tags (
    idArticle INT,
    idTag INT,
    FOREIGN KEY (idArticle) REFERENCES articles(idArticle) ON DELETE CASCADE,
    FOREIGN KEY (idTag) REFERENCES tags(idTag) ON DELETE CASCADE
);

CREATE TABLE comments (
    idComment INT AUTO_INCREMENT PRIMARY KEY,
    idArticle INT,
    idUser INT,
    content TEXT NOT NULL,
    visible BOOLEAN DEFAULT TRUE,
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idArticle) REFERENCES articles(idArticle) ON DELETE CASCADE,
    FOREIGN KEY (idUser) REFERENCES users(idUser)
);

CREATE TABLE favorites (
    idUser INT,
    idArticle INT,
    FOREIGN KEY (idUser) REFERENCES users(idUser),
    FOREIGN KEY (idArticle) REFERENCES articles(idArticle) ON DELETE CASCADE
);