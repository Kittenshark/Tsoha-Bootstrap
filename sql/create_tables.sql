-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
    username varchar(50),
    PRIMARY KEY (username),
    password varchar(50) NOT NULL,
    firstname varchar(50) NOT NULL,
    lasname varchar(50) NOT NULL,
    email varchar(50 NOT NULL,
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

    