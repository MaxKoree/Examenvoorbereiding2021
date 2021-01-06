

DROP DATABASE IF EXISTS flowerpower;
CREATE DATABASE flowerpower;
USE flowerpower;

CREATE TABLE medewerker(
    medewerkerscode VARCHAR(5),
    Voornaam VARCHAR(255),
    Achternaam VARCHAR(255),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY(medewerkerscode)
);

CREATE TABLE winkel(
    winkelcode VARCHAR(5),
    winkelnaam VARCHAR(20),
    winkeladres VARCHAR(35),
    winkelpostcode VARCHAR(6),
    vestigingsplaats VARCHAR(20),
    telefoonnummer VARCHAR(15),
    PRIMARY KEY(winkelcode)
);

CREATE TABLE klant(
    klantcode VARCHAR(5),
    voorletters VARCHAR(20),
    tussenvoegsel VARCHAR(20),
    achternaam VARCHAR(20),
    adres VARCHAR(35),
    postcode VARCHAR(6),
    woonplaats VARCHAR(20),
    geboortedatum DATE,
    gebruikersnaam VARCHAR(20),
    wachtwoord VARCHAR(250),
    PRIMARY KEY(klantcode)
);


CREATE TABLE artikel(
    artikelcode VARCHAR(5),
    artikel VARCHAR(20),
    prijs VARCHAR(3),
    PRIMARY KEY(artikelcode)
);

CREATE TABLE factuur(
    factuurnummer VARCHAR(3),
    factuurdatum DATE,
    klantcode VARCHAR(5),
    PRIMARY KEY(factuurnummer),
    FOREIGN KEY(klantcode) REFERENCES klant(klantcode)
);

CREATE TABLE factuurregel(
    factuurnummer VARCHAR(3),
    artikelcode VARCHAR(5),
    aantal INT(3),
    prijs INT(3),
    FOREIGN KEY(factuurnummer) REFERENCES factuur(factuurnummer),
    FOREIGN KEY(artikelcode) REFERENCES artikel(artikelcode)
);

CREATE TABLE bestelling(
    artikelcode VARCHAR(5),
    winkelcode VARCHAR(5),
    aantal VARCHAR(20),
    klantcode VARCHAR(5),
    medewerkerscode VARCHAR(5),
    afgehaald INT,
    FOREIGN KEY(artikelcode) REFERENCES artikel(artikelcode),
    FOREIGN KEY(winkelcode) REFERENCES winkel(winkelcode),
    FOREIGN KEY(klantcode) REFERENCES klant(klantcode),
    FOREIGN KEY(medewerkerscode) REFERENCES medewerker(medewerkerscode)
);