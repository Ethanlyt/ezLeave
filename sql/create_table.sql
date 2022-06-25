CREATE TABLE ADMIN(
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    user_level VARCHAR(10) NOT NULL,
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);


CREATE TABLE STAFF(
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    user_level VARCHAR(10) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    ic_passport VARCHAR(30) NOT NULL,
    contact_no VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    staff_id VARCHAR(10) NOT NULL
);


CREATE TABLE MANAGER(
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    user_level VARCHAR(10) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    ic_passport VARCHAR(30) NOT NULL,
    contact_no VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    staff_id VARCHAR(10) NOT NULL
);

application_id,username,applicant_ID,date_submitted,username,
CREATE TABLE APPLICATION(
    application_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    applicant_ID INT NOT NULL,
    approval_manager_ID INT,

    date_submitted DATETIME NOT NULL,
    leave_date DATE NOT NULL,
    leave_reason VARCHAR(255) NOT NULL,
    approval_status VARCHAR(255) NOT NULL,
    
    last_modify DATETIME  ,
    manager_remark VARCHAR(255)
);



ALTER TABLE APPLICATION
    ADD CONSTRAINT staff_id_fk FOREIGN KEY(applicant_ID)
    REFERENCES STAFF(user_id);

ALTER TABLE APPLICATION
    ADD CONSTRAINT manager_name_fk FOREIGN KEY(approval_manager_ID)
    REFERENCES MANAGER(user_id);

ALTER TABLE STAFF
ADD CONSTRAINT staff_user_level_check CHECK (user_level IN ('ADMIN', 'MANAGER', 'STAFF'));

ALTER TABLE MANAGER
ADD CONSTRAINT manager_user_level_check CHECK (user_level IN ('ADMIN', 'MANAGER', 'STAFF'));

ALTER TABLE ADMIN
ADD CONSTRAINT admin_user_level_check CHECK (user_level IN ('ADMIN', 'MANAGER', 'STAFF'));

ALTER TABLE APPLICATION
ADD CONSTRAINT application_current_stats_check CHECK (approval_status IN ('PENDING', 'APPROVED', 'REJECTED','EXPIRED'));



-- Insert an admin
INSERT INTO ADMIN
(username, password, user_level)
VALUES
("hussein", "123456", "ADMIN");

-- Insert a test staff
INSERT INTO STAFF
(username, password, user_level, full_name, ic_passport, contact_no, email, staff_id)
VALUES
("John", "123456", "STAFF", "John Doe", "010101-01-0101", "011-12345678", "johndoe@gmail.com", "JD001");

-- Insert a test manager
INSERT INTO MANAGER
(username, password, user_level, full_name, ic_passport, contact_no, email, staff_id)
VALUES
("Bob", "123456", "MANAGER", "Bob Kahn", "020202-02-0202", "019-87654321", "bobkhan@gmail.com", "BK001");