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
    contact_no VARCHAR(11) NOT NULL,
    email VARCHAR(10) NOT NULL,
    staff_id VARCHAR(10) NOT NULL
);


CREATE TABLE MANAGER(
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    user_level VARCHAR(10) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    ic_passport VARCHAR(30) NOT NULL,
    contact_no VARCHAR(11) NOT NULL,
    email VARCHAR(10) NOT NULL,
    manager_id VARCHAR(10) NOT NULL
);


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
ADD CONSTRAINT staff_user_level_check CHECK (user_level IN ('ADMIN', 'MANGER', 'STAFF'));

ALTER TABLE MANAGER
ADD CONSTRAINT manager_user_level_check CHECK (user_level IN ('ADMIN', 'MANGER', 'STAFF'));

ALTER TABLE ADMIN
ADD CONSTRAINT admin_user_level_check CHECK (user_level IN ('ADMIN', 'MANGER', 'STAFF'));

ALTER TABLE APPLICATION
ADD CONSTRAINT application_current_stats_check CHECK (approval_status IN ('PENDING', 'APPROVED', 'REJECTED','EXPIRED'));