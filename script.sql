SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE IF NOT EXISTS `Stores`(
    `Store_ID` int  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Store_Address` VARCHAR(100),
    `Phone_Number` VARCHAR(16)
);
CREATE TABLE IF NOT EXISTS `Suppliers`(
     `Supplier_ID` int  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Supplier_Name` VARCHAR(20),
    `Supplier_Address` VARCHAR(100),
    `Phone_Number` VARCHAR(16) UNIQUE
);

CREATE TABLE IF NOT EXISTS `Stock_Delivery`(
     `Delivery_ID` int NOT NULL AUTO_INCREMENT,
     `Store_ID` int NOT NULL,
     `Supplier_ID` int NOT NULL,
     `TotalCost` decimal(8,2) NOT NULL,
     PRIMARY KEY(`Delivery_ID`),
     FOREIGN KEY (`Store_ID`) REFERENCES `Stores`(`Store_ID`),
     FOREIGN KEY (`Supplier_ID`) REFERENCES `Suppliers`(`Supplier_ID`)
);

CREATE TABLE IF NOT EXISTS `Staff` (
     `Staff_ID` int NOT NULL AUTO_INCREMENT,
     `Name` varchar(70) NOT NULL,
     `Address` varchar(64) NOT NULL,
     `Phone` varchar(16) NOT NULL UNIQUE,
     `Email` varchar(50)NOT NULL UNIQUE,
     `Emergency_Contact` varchar(16) NOT NULL,
     `Salary` int NOT NULL,
     `Role` VARCHAR (32) NOT NULL,
     `Store_ID` int NOT NULL,
     PRIMARY KEY(`Staff_ID`),
     FOREIGN KEY (`Store_ID`) REFERENCES `Stores`(`Store_ID`)
);

CREATE TABLE IF NOT EXISTS `Shift` (
     `Shift_ID` int NOT NULL AUTO_INCREMENT,
     `Role` varchar(32) NOT NULL,
     `Start_Time` datetime NOT NULL,
     `End_Time` datetime NOT NULL,
     PRIMARY KEY(`Shift_ID`)
);

CREATE TABLE IF NOT EXISTS `Staff_Shift`(
     `Staff_Shift_ID` int NOT NULL AUTO_INCREMENT,
     `Staff_ID` int NOT NULL,
     `Shift_ID` int NOT NULL,
     PRIMARY KEY(`Staff_Shift_ID`),
     FOREIGN KEY (`Staff_ID`) REFERENCES `Staff`(`Staff_ID`),
     FOREIGN KEY (`SHIFT_ID`) REFERENCES `Shift`(`Shift_ID`)
);

CREATE TABLE IF NOT EXISTS `Product`(
     `Product_ID` int NOT NULL AUTO_INCREMENT,
     `Category` varchar(20),
     `product_name` varchar(70) NOT NULL,
     `product_image` varchar(255),
     `product_description` varchar(255),
     `key_words` varchar(255),
     `manufacturer` varchar(100),
     `retail_price` decimal(7,2) NOT NULL,
     `bulk_price` decimal(7,2) NOT NULL,
     PRIMARY KEY(`Product_ID`)
);

CREATE TABLE IF NOT EXISTS `StoreProducts` (
    `StoreProducts_ID` INT NOT NULL AUTO_INCREMENT,
    `Store_ID` INT NOT NULL,
    `Product_ID` INT NOT NULL,
    `Quantity` INT NOT NULL,
    PRIMARY KEY (`StoreProducts_ID`),
    FOREIGN KEY (`Store_ID`)
        REFERENCES `Stores` (`Store_ID`),
    FOREIGN KEY (`Product_ID`)
        REFERENCES `Product` (`Product_ID`)
);

CREATE TABLE IF NOT EXISTS `Payment`(
      `Payment_ID` int NOT NULL AUTO_INCREMENT,
      `Method` varchar(20) NOT NULL,
      `Amount` decimal(7,2) NOT NULL,
      PRIMARY KEY(`Payment_ID`)
);

CREATE TABLE IF NOT EXISTS `ShippingAddress`(
      `ShippingAddress_ID` int NOT NULL AUTO_INCREMENT,
      `Address` varchar(64) NOT NULL,
      `City` varchar(40) NOT NULL,
      `Postcode` varchar(8) NOT NULL,
      `Special_Request` varchar(255),
      PRIMARY KEY(`ShippingAddress_ID`)
);

CREATE TABLE IF NOT EXISTS `BillingAddress`(
      `BillingAddress_ID` int NOT NULL AUTO_INCREMENT,
      `Address` varchar(64) NOT NULL,
      `City` varchar(40) NOT NULL,
      `Postcode` varchar(8) NOT NULL,
      PRIMARY KEY(`BillingAddress_ID`)
);

CREATE TABLE IF NOT EXISTS `User`(
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(35) NOT NULL,
  `Second_Name` varchar(35) NOT NULL,
  `Email` varchar(50) NOT NULL UNIQUE,
  `BillingAddress_ID` int NOT NULL,
  `ShippingAddress_ID` int NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Role` varchar(32) NOT NULL,
  PRIMARY KEY(`User_ID`),
  FOREIGN KEY(`BillingAddress_ID`) REFERENCES `BillingAddress`(`BillingAddress_ID`),
  FOREIGN KEY(`ShippingAddress_ID`) REFERENCES `ShippingAddress`(`ShippingAddress_ID`)
);
CREATE TABLE IF NOT EXISTS `Orders`(
  `Order_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Date` datetime NOT NULL,
  `ShippingAddress_ID` int NOT NULL,
  `BillingAddress_ID` int NOT NULL,
  `Payment_ID` int NOT NULL,
  PRIMARY KEY(`Order_ID`),
  FOREIGN KEY(`User_ID`) REFERENCES `User`(`User_ID`),
  FOREIGN KEY(`ShippingAddress_ID`) REFERENCES `ShippingAddress`(`ShippingAddress_ID`),
  FOREIGN KEY(`BillingAddress_ID`) REFERENCES `BillingAddress`(`BillingAddress_ID`),
  FOREIGN KEY(`Payment_ID`) REFERENCES `Payment`(`Payment_ID`)
);

CREATE TABLE IF NOT EXISTS `Order_Product`(
  `Order_Product_ID` int NOT NULL AUTO_INCREMENT,
  `Product_ID` int NOT NULL, 
  `Order_ID` int NOT NULL,
  `Quantity` int NOT NULL,
  PRIMARY KEY(`Order_Product_ID`),
  FOREIGN KEY(`Product_ID`) REFERENCES `Product`(`Product_ID`),
  FOREIGN KEY(`Order_ID`) REFERENCES `Orders`(`Order_ID`)
);

-- VIEWS
-------------------------------------------------------
-- case_view
-- cooler_sview
-- cpu_sview
-- gpu_view
-- Manager_Orders
-- Manager_Products
-- mother_boardview
-- phone_view
-- psu_view
-- ram_view
-- storage_view
-- supplier_view
-- user_loginview
-- user_profileview

CREATE OR REPLACE VIEW `case_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'Case');

CREATE OR REPLACE VIEW `clients_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`
    FROM
        `product`;

CREATE OR REPLACE VIEW `cooler_sview` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'Cooler');
    
CREATE OR REPLACE VIEW `cpu_sview` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'CPU');

CREATE OR REPLACE VIEW `gpu_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'GPU');

CREATE OR REPLACE VIEW `Manager_Orders` AS
    SELECT 
        `Order_ID`,
        `User`.`User_ID`,
        `First_Name`,
        `Second_Name`,
        `Email`,
        `Date`,
        `shippingaddress`.`ShippingAddress_ID`,
        `shippingaddress`.`Address` AS 'ShippingAddress',
        `shippingaddress`.`City` AS 'ShippingCity',
        `shippingaddress`.`Postcode` AS 'ShippingPostcode',
        `shippingaddress`.`Special_Request`,
        `billingaddress`.`BillingAddress_ID`,
        `billingaddress`.`Address` AS 'BillingAddress',
        `billingaddress`.`City` AS 'BillingCity',
        `billingaddress`.`Postcode` AS 'BillingPostcode',
        `payment`.`Payment_ID`,
        `Method`,
        `Amount`
    FROM
        `orders`,
        `user`,
        `shippingaddress`,
        `billingaddress`,
        `payment`
    WHERE
        `orders`.`ShippingAddress_ID` = `shippingaddress`.`ShippingAddress_ID`
            AND `orders`.`BillingAddress_ID` = `billingaddress`.`BillingAddress_ID`
            AND `orders`.`User_ID` = `user`.`User_ID`
            AND `orders`.`Payment_ID` = `payment`.`Payment_ID`;

CREATE OR REPLACE VIEW `Manager_Products` AS
    SELECT 
        `Product_ID`,
        `product_name`,
        `Category`,
        `product_image`,
        `product_description`,
        `key_words`,
        `manufacturer`,
        `retail_price`,
        `bulk_price`,
        (SELECT 
                SUM(`storeproducts`.`quantity`) - SUM(`order_product`.`quantity`)
            FROM
                `storeproducts`,
                `order_product`
            WHERE
                `storeproducts`.`Product_ID` = `Product`.`Product_ID`
                    OR `order_product`.`Product_ID` = `Product`.`Product_ID`) AS 'Product_Quantity'
    FROM
        `Product`
    GROUP BY `Product_ID`;

CREATE OR REPLACE VIEW `mother_boardview` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'Motherboard');

    CREATE OR REPLACE VIEW `phone_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'phone');

    CREATE OR REPLACE VIEW `psu_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'PSU');
    CREATE OR REPLACE VIEW `ram_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'RAM');
    
    CREATE OR REPLACE VIEW `storage_view` AS
    SELECT 
        `product`.`Product_image` AS `Product_image`,
        `product`.`Product_name` AS `Product_name`,
        `product`.`Retail_price` AS `Retail_price`,
        `product`.`Product_description` AS `Product_description`,
        `product`.`Product_ID` AS `Product_ID`,
        `product`.`Category` AS `Category`,
        `product`.`Bulk_price` AS `Bulk_price`,
        `product`.`Manufacturer` AS `Manufacturer`
    FROM
        `product`
    WHERE
        (`product`.`Category` = 'Storage');

    CREATE OR REPLACE VIEW `supplier_view` AS
    SELECT 
        `stock_delivery`.`Delivery_ID` AS `Delivery_ID`,
        `stores`.`Store_Address` AS `Store_Address`,
        `stores`.`Phone_Number` AS `Phone_Number`,
        `stock_delivery`.`TotalCost` AS `TotalCost`
    FROM
        (`stock_delivery`
        JOIN `stores`)
    WHERE
        (`stock_delivery`.`Store_ID` = `stores`.`Store_ID`);
    
    CREATE OR REPLACE VIEW `user_loginview` AS
    SELECT 
        `user`.`User_ID` AS `User_ID`,
        `user`.`Email` AS `Email`,
        `user`.`Password` AS `Password`,
        `user`.`First_Name` AS `First_Name`,
        `user`.`Second_Name` AS `Second_Name`
    FROM
        `user`;

    CREATE OR REPLACE VIEW `user_profileview` AS
    SELECT 
        `user`.`User_ID` AS `User_ID`,
        `user`.`First_Name` AS `First_Name`,
        `user`.`Second_Name` AS `Second_Name`,
        `user`.`Email` AS `Email`
    FROM
        `user`;

-- STORED PROCEDURES
-------------------------------------------------------
-- manager_get_overview
-- manager_get_products_overview(IN term VARCHAR(30))
-- manager_add_product(IN prod_name VARCHAR(20), IN prod_category VARCHAR(20), IN prod_image VARCHAR(100), IN prod_description VARCHAR(100), IN prod_key_words VARCHAR(255), IN prod_manufacturer VARCHAR(100), IN prod_retail_price DECIMAL(7,2), IN prod_bulk_price decimal(7,2))
-- manager_get_product(IN prod_id INT)
-- manager_delete_product(IN prod_id INT)
-- manager_update_product(IN prod_id INT, IN prod_name VARCHAR(20), IN prod_category VARCHAR(20), IN prod_image VARCHAR(100), IN prod_description VARCHAR(100), IN prod_key_words VARCHAR(255), IN prod_manufacturer VARCHAR(100), IN prod_retail_price DECIMAL(7,2), IN prod_bulk_price decimal(7,2))
-- manager_get_orders_overview()
-- manager_delete_order(IN ord_id INT)
-- manager_get_order(IN ord_id INT)
-- manager_update_order(IN ord_id INT, IN shipping_ID INT, IN billing_ID INT, IN pay_id INT, IN u_id INT, IN u_first_name VARCHAR(70), IN u_second_name VARCHAR(35), IN u_email VARCHAR(50), IN ship_address VARCHAR(64), IN ship_city VARCHAR(40), IN ship_postcode VARCHAR(8), IN ship_special_request VARCHAR(100), IN bill_address VARCHAR(64), IN bill_city VARCHAR(40), IN bill_postcode VARCHAR(8), IN pay_method VARCHAR(20), IN pay_amount DECIMAL(7,2))


DELIMITER //
DROP PROCEDURE IF EXISTS manager_get_overview;
CREATE PROCEDURE manager_get_overview()
BEGIN 
SELECT 
    (SELECT 
            SUM(amount)
        FROM
            payment) AS 'TotalSales',
    (SELECT 
            SUM(TotalCost)
        FROM
            stock_delivery) AS 'TotalExpenses',
    (SELECT 
            COUNT(`user`.User_ID)
        FROM
            `user`) AS 'TotalUsers',
    (SELECT 
            COUNT(`orders`.Order_ID)
        FROM
            `orders`) AS 'TotalOrders';
END//

DROP PROCEDURE IF EXISTS manager_get_products_overview;
CREATE PROCEDURE manager_get_products_overview(IN term VARCHAR(30))
BEGIN
SELECT Product_ID, product_name, product_image, product_description, retail_price, bulk_price, product_quantity 
FROM manager_products
WHERE product_name LIKE CONCAT('%', term, '%') OR product_description LIKE CONCAT('%', term, '%') OR key_words LIKE CONCAT('%', term, '%') OR manufacturer LIKE CONCAT('%', term, '%') OR Category LIKE CONCAT('%', term, '%');
END//

DROP PROCEDURE IF EXISTS manager_add_product;
CREATE PROCEDURE manager_add_product(IN prod_name VARCHAR(20), IN prod_category VARCHAR(20), IN prod_image VARCHAR(100), IN prod_description VARCHAR(100), IN prod_key_words VARCHAR(255), IN prod_manufacturer VARCHAR(100), IN prod_retail_price DECIMAL(7,2), IN prod_bulk_price decimal(7,2))
BEGIN
	INSERT INTO product(product_name, Category, product_image, product_description, key_words, manufacturer, retail_price, bulk_price) 
    VALUES (prod_name, prod_category, prod_image, prod_description, prod_key_words, prod_manufacturer, prod_retail_price, prod_bulk_price);
END//

DROP PROCEDURE IF EXISTS manager_get_product;
CREATE PROCEDURE manager_get_product(IN prod_id INT)
BEGIN
    SELECT * FROM manager_products WHERE Product_ID = prod_id;
END//

DROP PROCEDURE IF EXISTS manager_delete_product;
CREATE PROCEDURE manager_delete_product(IN prod_id INT)
BEGIN
	DELETE FROM order_product WHERE Product_ID = prod_id;
    DELETE FROM storeproducts WHERE Product_ID = prod_id;
    DELETE FROM product WHERE Product_ID = prod_id;
END//

DROP PROCEDURE IF EXISTS manager_update_product;
CREATE PROCEDURE manager_update_product(IN prod_id INT, IN prod_name VARCHAR(20), IN prod_category VARCHAR(20), IN prod_image VARCHAR(100), IN prod_description VARCHAR(100), IN prod_key_words VARCHAR(255), IN prod_manufacturer VARCHAR(100), IN prod_retail_price DECIMAL(7,2), IN prod_bulk_price decimal(7,2))
BEGIN
    UPDATE Product SET product_name = prod_name, Category = prod_category, product_image = prod_image, description = prod_description, key_words = prod_key_words, manufacturer = prod_manufacturer, retail_price = prod_retail_price, bulk_price = prod_bulk_price 
    WHERE Product_ID = prod_id;
END//

DROP PROCEDURE IF EXISTS manager_get_orders_overview;
CREATE PROCEDURE manager_get_orders_overview()
BEGIN
SELECT Order_ID, First_Name, Second_Name, Email, Date, ShippingAddress, ShippingCity, ShippingPostcode, Amount
FROM manager_orders;
END//

DROP PROCEDURE IF EXISTS manager_delete_order;
CREATE PROCEDURE manager_delete_order(IN ord_id INT)
BEGIN
	DELETE FROM order_product WHERE Order_ID = ord_id;
    DELETE FROM `orders` WHERE Order_ID = ord_id;
END//

DROP PROCEDURE IF EXISTS manager_get_order;
CREATE PROCEDURE manager_get_order(IN ord_id INT)
BEGIN
    SELECT * FROM manager_orders WHERE Order_ID = ord_id;
END//

DROP PROCEDURE IF EXISTS manager_update_order;
CREATE PROCEDURE manager_update_order(IN ord_id INT, IN shipping_ID INT, IN billing_ID INT, IN pay_id INT, IN u_id INT, IN u_first_name VARCHAR(70), IN u_second_name VARCHAR(35), IN u_email VARCHAR(50), IN ship_address VARCHAR(64), IN ship_city VARCHAR(40), IN ship_postcode VARCHAR(8), IN ship_special_request VARCHAR(100), IN bill_address VARCHAR(64), IN bill_city VARCHAR(40), IN bill_postcode VARCHAR(8), IN pay_method VARCHAR(20), IN pay_amount DECIMAL(7,2))
BEGIN
    UPDATE `user` SET First_Name = u_first_name, Second_Name = u_second_name, Email = u_email WHERE `User_ID` = u_id;
UPDATE shippingaddress 
SET 
    address = ship_address,
    city = ship_city,
    postcode = ship_postcode,
    special_request = ship_special_request
WHERE
    ShippingAddress_ID = shipping_ID;
UPDATE billingaddress 
SET 
    address = bill_address,
    city = bill_city,
    postcode = bill_postcode
WHERE
    BillingAddress_ID = billing_ID;
UPDATE payment 
SET 
    method = pay_method,
    amount = pay_amount
WHERE
    pay_id = payment_ID;
END//
