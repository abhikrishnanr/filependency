CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('superadmin','deptadmin','sectionofficer'),
  department_id INT,
  section_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE file_status_updates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  file_id VARCHAR(50),
  department_id INT,
  section_id INT,
  seat_id INT,
  year YEAR,
  category_id INT,
  status ENUM('Pending','Closed'),
  updated_by INT,
  updated_at DATETIME,
  UNIQUE KEY unique_file (file_id, year, category_id)
);

-- Insert a demo super admin user
INSERT INTO users (name, email, password, role)
VALUES ('Main User', 'someone@example.com',
        '$2y$12$XhrhUZSZtoMZoKHC5mr42.2gSRwQCBu.xOrDamwMTakN.6C5oB61K',
        'superadmin');
