-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO Apartment (name, password) VALUES ('A1', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Apartment (name, password) VALUES ('A2', 'Henri123');
-- Game taulun testidata
INSERT INTO Reservation (reserved, reserved) VALUES (true, NOW());

