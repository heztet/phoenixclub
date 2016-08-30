-- Create Side
ALTER TABLE  `phoenix_students` ADD  `Side` VARCHAR( 2 ) NOT NULL AFTER  `Floor` ;

-- Get Side
UPDATE phoenix_students SET Side='E' WHERE Floor LIKE '%E';
UPDATE phoenix_students SET Side='W' WHERE Floor LIKE '%W';

-- Get FloorTemp
ALTER TABLE `phoenix_students` ADD `FloorTemp` INT NOT NULL AFTER `TotalPoints`;
UPDATE phoenix_students SET FloorTemp=1 WHERE Floor Like '1%';
UPDATE phoenix_students SET FloorTemp=2 WHERE Floor Like '2%';
UPDATE phoenix_students SET FloorTemp=3 WHERE Floor Like '3%';
UPDATE phoenix_students SET FloorTemp=4 WHERE Floor Like '4%';
UPDATE phoenix_students SET FloorTemp=5 WHERE Floor Like '5%';
UPDATE phoenix_students SET FloorTemp=6 WHERE Floor Like '6%';
UPDATE phoenix_students SET FloorTemp=7 WHERE Floor Like '7%';
UPDATE phoenix_students SET FloorTemp=8 WHERE Floor Like '8%';
UPDATE phoenix_students SET FloorTemp=9 WHERE Floor Like '9%';
UPDATE phoenix_students SET FloorTemp=0 WHERE Floor Like '0%';

-- Wipe Floor and change to Int
UPDATE phoenix_students SET Floor = NULL;
ALTER TABLE `phoenix_students` CHANGE `Floor` `Floor` INT(3) NOT NULL;

-- Update Floor from FloorTemp
UPDATE phoenix_students SET Floor = FloorTemp;

-- Delete FloorTemp
ALTER TABLE `phoenix_students` DROP `FloorTemp`;