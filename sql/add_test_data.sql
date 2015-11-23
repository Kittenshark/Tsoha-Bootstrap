INSERT INTO Kayttaja (userid, username, password, firstname, lastname, email) 
    VALUES ('1', 'Ei', '300ei', 'Muumi', 'Peikko', 'jaa@ei.com');

INSERT INTO Kayttaja (userid, username, password, firstname, lastname, email) 
    VALUES ('2', 'Kayttaja', 'Salasana', 'Muumi', 'Peikko', 'jaa@ei.com');

INSERT INTO Tuoteryhma (id, fname, description) 
    VALUES ('1', 'Viherkasvi', 'Multaan istutettu kasvi');

INSERT INTO Tuoteryhma (id, fname, description) 
    VALUES ('2', 'Kimppu', 'Useasta kukasta koostuva kimppu');

INSERT INTO Tuote (id, fname, price, sale, description, orderIt, reserve, groupid) 
    VALUES ('1', 'Ruusukimppu', '5.90', '0.00', 'Uutuustuote', 'true', 'true', '2');

INSERT INTO Tuote (id, fname, price, sale, description, orderIt, reserve, groupid) 
    VALUES ('2', 'Tulppaanikimppu', '4.90', '0.00', 'Kevät', 'true', 'true', '2');

INSERT INTO Tilaus (orderid, OrderDay, arrivalAddress, billingAddress, product_id, orderer) 
    VALUES ('1', NOW(), 'santapeikko 5, Helsinki, Suomi', 'santapeikko 5, Helsinki, Suomi', '1', '1');