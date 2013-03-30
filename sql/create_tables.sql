CREATE TABLE Clients (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  first_name VARCHAR(50) NOT NULL, 
  last_name VARCHAR(50) NOT NULL, 
  state_id INT NOT NULL, 
  phone_home VARCHAR(10), 
  phone_work VARCHAR(10),
  phone_reference VARCHAR(10),
  phone_cell VARCHAR(10),
  address_home VARCHAR(200),
  address_work VARCHAR(200),
  time_stamp TIMESTAMP DEFAULT NOW(),
  INDEX(last_name(50))
);

CREATE TABLE Accounts (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  start_week INT NOT NULL, 
  amount INT NOT NULL, 
  n_payments INT NOT NULL,
  client_id INT NOT NULL, 
  n_paid INT NOT NULL,
  status ENUM('active','closed') DEFAULT 'active',
  time_stamp TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (client_id) REFERENCES Clients(id)
);

CREATE TABLE Receipts (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  account_id INT NOT NULL, 
  amount INT NOT NULL,
  payment_n INT NOT NULL, 
  time_stamp TIMESTAMP DEFAULT NOW(),
status ENUM('paid', 'not_paid') DEFAULT 'not_paid', 
  FOREIGN KEY (account_id) REFERENCES Accounts(id)
  -- Status: paid, partially_paid
);


/*SELECT * FROM Receipts 
WHERE Receipts.account_id IN (
  SELECT id from Accounts
  WHERE Accounts.client_id IN (
    SELECT id from Clients
    WHERE Clients.last_name = 'andrango' AND Clients.first_name = 'juan'
  )
)*/

-- ADD SOME CLIENTS 
INSERT INTO Clients (first_name, last_name, state_id) values ('juan', 'andrango',1717788747);
INSERT INTO Clients (first_name, last_name, state_id) values ('laura', 'munoz',  1231231234);


--Create new account for client Juan Andrango
--THE START_WEEK gets defined by the user!!!!!
--WHEn the account is created, the first receipt is created and set to no_paid
INSERT INTO Accounts (amount, n_payments, n_paid, client_id, start_week) 
SELECT 5000, 20, 0, id, WEEKOFYEAR(NOW()) FROM Clients
WHERE Clients.first_name = 'juan' AND Clients.last_name = 'andrango';
INSERT INTO Receipts (account_id, amount, payment_n)
SELECT Accounts.id, Accounts.amount/Accounts.n_payments, Accounts.n_paid + 1 FROM Accounts
WHERE Accounts.id = '1';


--Create Receipt for Account for Juan Andrango
--NOTE: need a way to identify which account ?!?!?
INSERT INTO Receipts (account_id, amount, payment_n) 
SELECT Accounts.id, Accounts.amount/Accounts.n_payments, Accounts.n_paid + 1 FROM Accounts
WHERE Accounts.client_id IN (
  SELECT id FROM Clients
  WHERE Clients.first_name = 'juan' AND Clients.last_name = 'Andrango'
);
--Also, we need to update the account (this all should be included in 
-- only one transaction)
UPDATE Accounts
SET n_paid = n_paid+1
WHERE EXISTS (
  SELECT id FROM Clients
  WHERE Clients.first_name = 'juan' AND Clients.last_name = 'Andrango'
);
