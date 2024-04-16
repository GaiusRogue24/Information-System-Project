CREATE TABLE students
(
    firstname VARCHAR (255) NOT NULL,
    middlename VARCHAR(255) NULL,
    lastname VARCHAR(255)  NOT NULL,
    indexnumber VARCHAR(20)  NOT NULL,
    birthday date,
    password text  NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255)  NOT NULL,
    picture bytea,
    agreed boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
    
)