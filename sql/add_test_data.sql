INSERT INTO Kayttaja (userId, username, password, firstname, lastname, email) VALUES ('1', 'Ei', 'Muumi', 'Peikko', 'jaa@ei.com');
INSERT INTO Tuoteryhma (id, fname, description) VALUES ('150', 'VIherkasvi', 'Ruukullinen kasvi');
INSERT INTO Tuote (id, fname, price, sale, description, orderIt, reserveIt) VALUES ('230', 'Ruusukimppu', '5,90', '0,00', 'true', 'true');
INSERT INTO Tilaus (orderId, price, OrderDay, arrivalAddress, billingAddress) VALUES ('3', '33,3', NOW(), 'santapeikko 5, Helsinki, Suomi', 'santapeikko 5, Helsinki, Suomi');