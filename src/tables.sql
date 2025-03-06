CREATE TABLE users (
    id CHAR(36) PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (id, username, email, password)
    VALUES (UUID(), 'mflasquin', 'maxime.flasquin@gmail.com', 'password');
INSERT INTO users (id, username, email, password)
    VALUES (UUID(), 'at', 'at@gmail.com', 'password2');