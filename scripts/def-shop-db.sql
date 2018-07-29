/* TODO: CREATE INDEXES*/

DROP DATABASE IF EXISTS def_shop;
CREATE DATABASE def_shop;

USE def_shop;

CREATE TABLE Users (
  id INTEGER auto_increment,
  name varchar(256) NOT NULL,
  email varchar(256) NOT NULL,
  password varchar(256) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Colors (
  id INTEGER auto_increment,
  name VARCHAR(256) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE Products (
  id INTEGER auto_increment,
  name VARCHAR(256) NOT NULL,
  gross_price DECIMAL(8, 2),
  tax DECIMAL(4, 2) NOT NULL default 10.00,
  net_price DECIMAL(8, 2) NOT NULL,
  image VARCHAR(256) NOT NULL,
  color_fk INTEGER,
  PRIMARY KEY(id),
  FOREIGN KEY (color_fk) REFERENCES Colors(id)
);


CREATE TABLE Orders (
  id INTEGER auto_increment,
  net_price DECIMAL(8, 2) NOT NULL,
  gross_price DECIMAL(8, 2) NOT NULL,
  user_fk INTEGER,
  payment_method INTEGER NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (user_fk) REFERENCES Users(id)
);

CREATE TABLE Orders_Products(
  order_fk INTEGER,
  product_fk INTEGER,
  quantity INTEGER NOT NULL,
  net_price DECIMAL(8, 2) NOT NULL,
  gross_price DECIMAL(8, 2) NOT NULL,
  tax DECIMAL(4, 2) NOT NULL,
  PRIMARY KEY(order_fk, product_fk),
  FOREIGN KEY (product_fk) REFERENCES Products(id),
  FOREIGN KEY (order_fk) REFERENCES Orders(id)
);

INSERT INTO Colors VALUES (1, 'maroon');
INSERT INTO Colors VALUES (2, 'orange');
INSERT INTO Colors VALUES (3, 'yellow');
INSERT INTO Colors VALUES (4, 'blue');
INSERT INTO Colors VALUES (5, 'green');

INSERT INTO Products VALUES (1, 'Product 1', 10, 10,11,'http://via.placeholder.com/350x150?text=product_1', 1);
INSERT INTO Products VALUES (2, 'Product 2', 20, 10,22,'http://via.placeholder.com/350x150?text=product_2', 1);
INSERT INTO Products VALUES (3, 'Product 3', 30, 10,33,'http://via.placeholder.com/350x150?text=product_3', 2);
INSERT INTO Products VALUES (4, 'Product 4', 40, 10,44,'http://via.placeholder.com/350x150?text=product_4', 3);
INSERT INTO Products VALUES (5, 'Product 5', 50, 10,55,'http://via.placeholder.com/350x150?text=product_5', 4);
INSERT INTO Products VALUES (6, 'Product 6', 60, 10,66,'http://via.placeholder.com/350x150?text=product_6', 5);
INSERT INTO Products VALUES (7, 'Product 7', 70, 10,77,'http://via.placeholder.com/350x150?text=product_7', 1);
INSERT INTO Products VALUES (8, 'Product 8', 80, 10,88,'http://via.placeholder.com/350x150?text=product_8', 2);
INSERT INTO Products VALUES (9, 'Product 9', 90, 10,99,'http://via.placeholder.com/350x150?text=product_9', 3);
INSERT INTO Products VALUES (10, 'Product 10', 100, 10,110,'http://via.placeholder.com/350x150?text=product_10', 4);
INSERT INTO Products VALUES (11, 'Product 11', 110, 10,121,'http://via.placeholder.com/350x150?text=product_11', 5);
INSERT INTO Products VALUES (12, 'Product 12', 120, 10,132,'http://via.placeholder.com/350x150?text=product_12', 1);
INSERT INTO Products VALUES (13, 'Product 13', 130, 10,143,'http://via.placeholder.com/350x150?text=product_13', 2);
INSERT INTO Products VALUES (14, 'Product 14', 140, 10,154,'http://via.placeholder.com/350x150?text=product_14', 3);
INSERT INTO Products VALUES (15, 'Product 15', 150, 10,165,'http://via.placeholder.com/350x150?text=product_15', 4);
INSERT INTO Products VALUES (16, 'Product 16', 160, 10,176,'http://via.placeholder.com/350x150?text=product_16', 5);
INSERT INTO Products VALUES (17, 'Product 17', 170, 10,187,'http://via.placeholder.com/350x150?text=product_17', 1);
INSERT INTO Products VALUES (18, 'Product 18', 180, 10,198,'http://via.placeholder.com/350x150?text=product_18', 2);
INSERT INTO Products VALUES (19, 'Product 19', 190, 10,209,'http://via.placeholder.com/350x150?text=product_19', 3);
INSERT INTO Products VALUES (20, 'Product 20', 200, 10,220,'http://via.placeholder.com/350x150?text=product_20', 4);
INSERT INTO Products VALUES (21, 'Product 21', 210, 10,231,'http://via.placeholder.com/350x150?text=product_21', 5);
INSERT INTO Products VALUES (22, 'Product 22', 220, 10,242,'http://via.placeholder.com/350x150?text=product_22', 1);
INSERT INTO Products VALUES (23, 'Product 23', 230, 10,253,'http://via.placeholder.com/350x150?text=product_23', 2);
INSERT INTO Products VALUES (24, 'Product 24', 240, 10,264,'http://via.placeholder.com/350x150?text=product_24', 3);
INSERT INTO Products VALUES (25, 'Product 25', 250, 10,275,'http://via.placeholder.com/350x150?text=product_25', 4);
INSERT INTO Products VALUES (26, 'Product 26', 260, 10,286,'http://via.placeholder.com/350x150?text=product_26', 5);
INSERT INTO Products VALUES (27, 'Product 27', 270, 10,297,'http://via.placeholder.com/350x150?text=product_27', 1);
INSERT INTO Products VALUES (28, 'Product 28', 280, 10,308,'http://via.placeholder.com/350x150?text=product_28', 2);
INSERT INTO Products VALUES (29, 'Product 29', 290, 10,319,'http://via.placeholder.com/350x150?text=product_29', 3);
INSERT INTO Products VALUES (30, 'Product 30', 300, 10,330,'http://via.placeholder.com/350x150?text=product30', 4);
INSERT INTO Products VALUES (31, 'Product 31', 310, 10,341,'http://via.placeholder.com/350x150?text=product_31', 5);
INSERT INTO Products VALUES (32, 'Product 32', 320, 10,352, 'http://via.placeholder.com/350x150?text=product_32', 1);
INSERT INTO Products VALUES (33, 'Product 33', 330, 10,363, 'http://via.placeholder.com/350x150?text=product_33', 2);
/*  */