-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Apartment (loginname, surname, password) VALUES ('A1','Korhonen', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Apartment (loginname, surname, password) VALUES ('A2','Mattila', 'Henri123');
INSERT INTO Apartment (loginname, surname, password) VALUES ('B2','Nieminen', 'Niemi123');
INSERT INTO Apartment (loginname, surname, password) VALUES ('B1','Svensson', 'Sven123');

INSERT INTO Sauna (address, name, price) VALUES('Hermannikermanninkatu 1','Sauna 2', 0);
INSERT INTO Sauna (address, name, price) VALUES('Leppäsuonkatu 13','The basement',  100);
INSERT INTO Sauna (address, name, price) VALUES('Gustaf Hellströmin katu 13','Iida', 0);

INSERT INTO Reservation (apartment_id, sauna_id, day, reserve_start, reserve_end) VALUES (2, 1, 25, '09:00:00', '11:00:00');
INSERT INTO Reservation (apartment_id, sauna_id, day, reserve_start, reserve_end) VALUES (1, 2, 24, '09:00:00', '12:00:00');
INSERT INTO Reservation (apartment_id, sauna_id, day, reserve_start, reserve_end) VALUES (3, 2, 23, '08:00:00', '09:00:00');