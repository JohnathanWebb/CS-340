INSERT INTO owner (first_name, last_name, email, phone, address, zipcode, password, state)
VALUES 
( 'James', 'Cosima', 'James@email.ml', '555-555-5551', '123 West Place', '97001', '123Password', 'Oregon'),
( 'John', 'Smith', 'John@email.ml', '555-555-5552', '124 East Place', '97002', '123Password', 'Washington'),
( 'Robert', 'Andea', 'Robert@email.ml', '555-555-5553', '125 West Place', '97003', '123Password', 'Oregon'),
( 'Michael', 'Pork', 'Michael@email.ml', '555-555-5554', '126 East Place', '97004', '123Password', 'Oregon'),
( 'William', 'Jork', 'William@email.ml', '555-555-5555', '124 West Place', '97005', '123Password', 'Washington'),
( 'David', 'Mork', 'David@email.ml', '555-555-5556', '125 East Place', '97006', '123Password', 'Oregon');


INSERT INTO vet (clinic_name, address, state, zipcode, phone, email)
VALUES 
('Frank and Frank Vet', '123 Bark Place', 'Oregon', '97001', '555-555-5551', 'Bark@barkmail.mo'),
('Bobs Vet and Pets', '777 Pet Road', 'Washington', '97777', '555-555-5552', 'Meow@MeowMail.mew'),
('Millys Billy Goats ', 'Rainbow Bridge way 123', 'Oregon', '97002', '555-555-5553', 'Billy@Billy.billy'),
('Hogs Dogs', 'Sharks way 333', 'Washington', '97778', '555-555-5554', 'Cat@cat.cat'),
('PET ER', 'Meow 122', 'Oregon', '90210', '555-555-5555', 'bark@bark.bark'),
('Shepards Anatomy', 'Street Street 11', 'Washington', '90210', '555-555-5556', 'whateven@isthis.email'),
('Marks Barks', 'Mark IS HERE 333', 'Oregon', '90210', '555-555-5557', 'Igiveup@inogood.atthis'),
('Mandys Dogtor', 'MOOO 333', 'Washington', '90210', '555-555-5558', 'email@naming.thing'),
('Punny Punns', 'Booooo 23', 'Oregon', '90210', '555-555-5559', 'meeee@dddd.aaa'),
('VETS VETS', 'Evergreen Street 33', 'Washington', '90210', '555-555-5560', 'aaa@bbb.ccc');



INSERT INTO service (type)
VALUES
('Immunization: Rabies'),
('Yearly checkup'),
('Blood test'),
('Spaying'),
('Neutering'),
('Teeth Cleaning'),
('Bark Transplant');



INSERT INTO pet (name, animal, birthdate, owner_id, insurance)
VALUES
('Scruffy', 'Mix', '2005/12/01', (SELECT owner_id FROM owner WHERE first_name = James' AND last_name = 'Cosima'), NULL),
('Max', 'Poodle', '2013/10/22', (SELECT owner_id FROM owner WHERE first_name = 'Robert' AND last_name = 'Andea'), 'Petco Insurance');



INSERT INTO visit (date, pet_id, vet_id, cost, service_id, file_upload)
VALUES ('2020/10/15', (SELECT pet_id FROM pet WHERE owner_id = '1'), (SELECT vet_id FROM vet WHERE clinic_name = 'Frank and Frank Vet'), '$350.00', (SELECT service_id FROM service WHERE type = 'Spaying'), NULL); 



-- Used to update owners account
-- Values to be updated would be defined by the user on their page while updating 
-- Here we use the address value as an example
UPDATE owner
SET address = :address_input
WHERE owner_id = :input_id;


-- Used to create owners account 
INSERT INTO owner (first_name, last_name, email, phone, address, zipcode, password, state)
VALUES (:fname_input, :lname_input, :email_input, :phone_input, :zipcode_input, :password_input, :state_input);

-- Used to delete owners account 
DELETE FROM owner
WHERE owner_id = :input_id;


-- Used to add pet
INSERT INTO pet (name, animal, birthdate, owner_id, insurance)
VALUES (:input_name, :input_animal, :input_birthdate, (SELECT owner_id FROM owner WHERE email = :onwers_email), :insurance);

-- Used to update pet
-- Adding new insurance for example 
UPDATE pet
SET insurance = :input_insurance
WHERE pet_id = :input_pet_id;

-- Used to delete pet
DELETE FROM pet
WHERE pet_id = :input_pet_id;


-- Used to create visit 
INSERT INTO visit (date, pet_id, vet_id, cost, service_id, file_upload)
VALUES (:input_date, (SELECT pet_id FROM pet WHERE owner_id = :input_id), (SELECT vet_id FROM vet WHERE clinic_name = :input_name), :input_cost, (SELECT service_id FROM service WHERE type = :input_type, :input_file);

-- Used to edit visit 
-- For example updating cost
UPDATE visit
SET cost = :new_cost
WHERE pet_id = :input_id;

-- Used to delete visit 
DELETE FROM visit
WHERE visit_id = :input_id;

-- Used to add vet 
INSERT INTO vet (clinic_name, address, state, zipcode, phone, email)
VALUES 
(:input_name, :input_address, :input_state, :input_zip, :input_phone, :input_email);

-- Used to delete vet 
DELETE FROM vet
WHERE vet_id = :input_vet_id;

-- Used to update vet 
-- For example updating the phone
UPDATE vet
SET phone = :new_Number
WHERE vet_id = :input_id;

-- Used to create service 
INSERT INTO service (type)
VALUES (:type_text_input);

-- Used to update services 
-- For example descrition
UPDATE service
SET type = :Updated_Type
WHERE service_id = :input_id;



-- Used to show all vets within a set state
SELECT * FROM vet 
WHERE state = :input_state;












