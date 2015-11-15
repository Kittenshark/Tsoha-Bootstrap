INSERT INTO Kayttaja (userId, username, password, firstname, lasname, email) VALUES ('1', 'Ei', '300ei', 'Muumi', 'Peikko', 'jaa@ei.com');
INSERT INTO Tuoteryhma (id, fname, description) VALUES ('400', 'Viherkasvi', 'Ruukullinen kasvi');
INSERT INTO Tuote (tid, fname, price, sale, description, orderIt, reserve) VALUES ('230', 'Ruusukimppu', '5.90', '0.00', 'Uutuustuote', 'true', 'true');
INSERT INTO Tilaus (orderid, OrderDay, arrivalAddress, billingAddress) VALUES ('3', NOW(), 'santapeikko 5, Helsinki, Suomi', 'santapeikko 5, Helsinki, Suomi');