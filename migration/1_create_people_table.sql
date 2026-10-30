CREATE TABLE people(
	pid INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(500) NOT NULL,
    last_name VARCHAR(500) NOT NULL,
    DOB DATE NOT NULL,
    phone VARCHAR(500) NOT NULL,
    email VARCHAR(500) NOT NULL,
    p_password VARCHAR(500) NOT NULL,
    p_status VARCHAR(100) DEFAULT 'Active',
    deleted_at DATE,
    is_admin BOOLEAN DEFAULT 0,
    PRIMARY KEY(pid)
);