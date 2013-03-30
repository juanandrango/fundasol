

CREATE TABLE Clients (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  first_name VARCHAR(50) NOT NULL, 
  last_name VARCHAR(50) NOT NULL, 
  time_stamp TIMESTAMP DEFAULT NOW(),
  INDEX(last_name(50))
);

CREATE TABLE Accounts (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  time_stamp TIMESTAMP DEFAULT NOW(),
  amount INT NOT NULL, 
  n_payments INT NOT NULL,
  client_id INT NOT NULL, 
  n_paid INT NOT NULL,
  status ENUM('active','closed') DEFAULT 'active',
  FOREIGN KEY (client_id) REFERENCES Clients(id)
);

CREATE TABLE Receipts (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  account_id INT NOT NULL, 
  amount INT NOT NULL,
  payment_n INT NOT NULL, 
  time_stamp TIMESTAMP DEFAULT NOW(),
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
INSERT INTO Clients (first_name, last_name) values ('juan', 'andrango');
INSERT INTO Clients (first_name, last_name) values ('laura', 'munoz');
INSERT INTO Clients (first_name, last_name) values ('andres', 'espin');
INSERT INTO Clients (first_name, last_name) values ('longlastname', 'gonzalez-munoz-andrango');


--Create new account for client Juan Andrango
INSERT INTO Accounts (amount, n_payments, n_paid, client_id) 
SELECT 2000, 10, 0, id FROM Clients
WHERE Clients.first_name = 'juan' AND Clients.last_name = 'andrango';

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
