CREATE TABLE treatment(
	tid INT NOT NULL AUTO_INCREMENT,
    t_name VARCHAR(500) NOT NULL,
    t_duration INT NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    category INT NOT NULL,
    t_status VARCHAR(100) DEFAULT 'Active',
    PRIMARY KEY(tid),
    FOREIGN KEY(category) REFERENCES category(cid)
);





