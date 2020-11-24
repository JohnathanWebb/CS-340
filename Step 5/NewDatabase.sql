CREATE TABLE owner (
	owner_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	first_name VARCHAR (30) NOT NULL,
	last_name VARCHAR(30) NOT NULL,
	email VARCHAR(100) NOT NULL,
	phone VARCHAR (15),
	password VARCHAR(255) NOT NULL
);


CREATE TABLE pet (
	pet_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	pet_name VARCHAR(30) NOT NULL,
	species VARCHAR (30) NOT NULL,
	birthdate DATE NOT NULL,
	pet_weight DECIMAL(5,2) NOT NULL,
	sex BIT NOT NULL,
	owner_id INT,
	FOREIGN KEY(owner_id) REFERENCES owner(owner_id)
);


CREATE TABLE vet (
	vet_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	clinic_name VARCHAR (100) NOT NULL,
	clinic_address VARCHAR(100) NOT NULL,
	city VARCHAR (50) NOT NULL,
	state VARCHAR(20) NOT NULL,
	zipcode VARCHAR(10) NOT NULL,
	phone VARCHAR(15) NOT NULL
);


CREATE TABLE visit (
	visit_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	visit_date DATE NOT NULL,
	pet_id INT NOT NULL,
	FOREIGN KEY(pet_id) REFERENCES pet(pet_id),
	vet_id INT NOT NULL,
	FOREIGN KEY(vet_id) REFERENCES vet(vet_id),
	total_cost DECIMAL(10, 2) NOT NULL 
);


CREATE TABLE service (
service_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
service_type VARCHAR (255)
);

CREATE TABLE servicevisit (
	service_visit_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	service_id INT NOT NULL,
	FOREIGN KEY (service_id) REFERENCES service(service_id),
	visit_id INT NOT NULL,
	service_price DECIMAL (10, 2) NOT NULL
);