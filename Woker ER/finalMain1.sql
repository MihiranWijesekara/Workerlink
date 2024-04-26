CREATE TABLE Post (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    image VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    FOREIGN KEY (username) REFERENCES Users(username)
);


