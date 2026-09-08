CREATE DATABASE IF NOT EXISTS car_parts_store
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE car_parts_store;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 email VARCHAR(255) UNIQUE,
 password VARCHAR(255),
 role VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE shops (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 user_id INT,
 FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE invoices (
 id INT AUTO_INCREMENT PRIMARY KEY,
 shop_id INT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (shop_id) REFERENCES shops(id)
);

CREATE TABLE products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 price DECIMAL(10,2),
 image VARCHAR(200)
);

CREATE TABLE invoice_products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 invoice_id INT,
 product_id INT,
 FOREIGN KEY (invoice_id) REFERENCES invoices(id),
 FOREIGN KEY (product_id) REFERENCES products(id)
);

-- بيانات تجريبية (كلمة المرور للحسابات هي: password)
INSERT INTO users (id, name, email, password, role) VALUES 
(1, 'مدير النظام', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.euHfyY79i', 'admin'),
(2, 'مستخدم تجريبي', 'user@user.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.euHfyY79i', 'user');

INSERT INTO shops VALUES (1,'متجر قطع غيار السيارات',1);

INSERT INTO products (name,price,image) VALUES
('فلتر زيت',3000,'oil.png'),
('بطارية',25000,'battery.png'),
('فحمات فرامل',15000,'brake.png');
INSERT INTO products (name,price,image) VALUES
('زيت محرك',12000,'engine_oil.png'),
('شمعة إشعال',5000,'spark_plug.png'),
('فلتر هواء',4000,'air_filter.png');
INSERT INTO products (name,price,image) VALUES
('مبرد ماء',8000,'radiator.png'),
('كشاف أمامي',18000,'headlight.png'),
('مراية جانبية',7000,'side_mirror.png');
INSERT INTO products (name,price,image) VALUES
('إطار سيارة',22000,'car_tire.png'),
('مقود سيارة',16000,'steering_wheel.png'),
('مساعدات تعليق',14000,'suspension_shock.png');
INSERT INTO products (name,price,image) VALUES
('مكابح ABS',35000,'abs_brakes.png'),
('نظام عادم',27000,'exhaust_system.png'),
('مضخة وقود',23000,'fuel_pump.png');
INSERT INTO products (name,price,image) VALUES
('مبرد هواء',9000,'air_conditioner.png'),
('جهاز تحديد المواقع GPS',45000,'gps_device.png'),
('رادار خلفي',30000,'rear_radar.png');
