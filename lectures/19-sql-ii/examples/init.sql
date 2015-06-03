-- DDL

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(64),
  password VARCHAR(64)
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL ,
  price DECIMAL(10, 2) NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT FOREIGN KEY fk_orders_ref_users (user_id) REFERENCES users (id)
);

-- DML

INSERT INTO users (login, password) VALUES
  ('jesus', 'password'),
  ('kung fury', 'password'),
  ('uwe boll', ''),
  ('whale', 'password');

INSERT INTO orders (price, user_id) VALUES
  (12.22, 1),
  (12.31, 1),
  (500, 3),
  (500, 3),
  (125, 2),
  (500, 3),
  (25, 1),
  (115, 2);