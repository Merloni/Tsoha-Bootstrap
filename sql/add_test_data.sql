-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Apartment (loginname, surname, password) VALUES ('A1','Korhonen', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Apartment (loginname, surname, password) VALUES ('A2','Mattila', 'Henri123');

INSERT INTO Reservation (apartment_id, reserved) VALUES (1, false);

INSERT INTO Sauna (address, price) VALUES('Hermannikermanninkatu 1', 0);
