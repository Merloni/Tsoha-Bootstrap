-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Apartment{
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
};

CREATE TABLE Reservation{
	id SERIAL PRIMARY KEY,
	apartment_id INTEGER REFERENCES Apartment(id),
	reserved boolean DEFAULT FALSE,
	reservehour time,

};