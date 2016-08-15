-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Apartment (loginname, surname, password) VALUES ('A1','Korhonen', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Apartment (loginname, surname, password) VALUES ('A2','Mattila', 'Henri123');
INSERT INTO Apartment (loginname, surname, password) VALUES ('B2','Nieminen', 'Niemi123');
INSERT INTO Apartment (loginname, surname, password) VALUES ('B1','Svensson', 'Sven123');

INSERT INTO Sauna (address, price) VALUES('Hermannikermanninkatu 1', 0);
INSERT INTO Sauna (address, price) VALUES('Leppäsuonkatu 13', 100);
INSERT INTO Sauna (address, price) VALUES('Gustaf Hellströmin katu 13', 0);

INSERT INTO Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (2, 1, true, '120000', '130000');
INSERT INTO Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (1, 2, true, '140000', '150000');
INSERT INTO Reservation (apartment_id, sauna_id, reserved, reservestart, reserve_end) VALUES (3, 2, true, '160000', '170000');