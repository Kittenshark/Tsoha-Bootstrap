CREATE TABLE Kayttaja(
    userId SERIAL PRIMARY KEY,
    username varchar(50),
    --SERIAL PRIMARY KEY(username),
    password varchar(50) NOT NULL,
    firstname varchar(50) NOT NULL,
    lasname varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
);

CREATE TABLE Tuoteryhma(
    id SERIAL PRIMARY KEY,
    fname varchar(50) NOT NULL,
    description varchar(200),
);

CREATE TABLE Tuote(
    id SERIAL PRIMARY KEY,
    fname varchar(50) NOT NULL,
    price INTEGER NOT NULL,
    sale DECIMAL,
    description varchar(200),
    orderIt boolean DEFAULT FALSE,
    reserve boolean DEFAULT FALSE,
);

CREATE TABLE Tilaus(
    orderId SERIAL PRIMARY KEY,
    price decimal NOT NULL,
    orderDay TIMESTAMP,
    arrivalAddress varchar(70),
    billingAddress varchar(70),
    product_id INTEGER REFERENCE Tuote(id),
    orderer varchar(50) REFERENCE Kayttaja(username),
);

CREATE TABLE Varaus(
    reserveId SERIAL PRIMARY KEY,
    price decimal NOT NULL,
    wayOfPayment varchar(50) NOT NULL,
    orderDay TIMESTAMP,
    collectDay TIMESTAMP,
    product_id INTEGER REFERENCE Tuote(id),
    orderer varchar(50) REFERENCE Kayttaja(username),
);



    