CREATE TABLE Kayttaja(
    userid SERIAL PRIMARY KEY,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    firstname varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    email varchar(50) NOT NULL
);

CREATE TABLE Tuoteryhma(
    id SERIAL PRIMARY KEY,
    fname varchar(50) NOT NULL,
    description varchar(200)
);

CREATE TABLE Tuote(
    id SERIAL PRIMARY KEY,
    fname varchar(50) NOT NULL,
    price DECIMAL NOT NULL,
    sale DECIMAL,
    description varchar(200),
    orderIt boolean DEFAULT FALSE
);

CREATE TABLE TuoteJaRyhmaYhdiste(
    product_id INTEGER REFERENCES Tuote(id),
    groupid INTEGER REFERENCES Tuoteryhma(id),
    PRIMARY KEY(product_id, groupid)
);

CREATE TABLE Tilaus(
    orderId SERIAL PRIMARY KEY,
    price decimal,
    orderDay TIMESTAMP,
    arrivalAddress varchar(70),
    billingAddress varchar(70),
    product_id INTEGER REFERENCES Tuote(id),
    orderer INTEGER REFERENCES Kayttaja(userid)
);
    