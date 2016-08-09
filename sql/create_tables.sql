-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Apartment(
	id SERIAL PRIMARY KEY,
	loginname varchar(50) NOT NULL,
	surname varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Sauna(
	id SERIAL PRIMARY KEY,
	address varchar(50) NOT NULL,
	price INTEGER
);

CREATE TABLE Reservation(
	id SERIAL PRIMARY KEY,
	apartment_id INTEGER REFERENCES Apartment(id),
	sauna_id INTEGER REFERENCES Sauna(id),
	reserved boolean DEFAULT FALSE,
	reservestart time,
	reserve_end time
);



