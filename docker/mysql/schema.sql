CREATE TABLE IF NOT EXISTS words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(30) NOT NULL,
    length INT NOT NULL,
    accent_position INT NOT NULL,
    UNIQUE KEY (word)
);
