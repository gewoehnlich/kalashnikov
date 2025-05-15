CREATE TABLE IF NOT EXISTS words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(30) NOT NULL,
    syllable_count INT NOT NULL,
    syllable_accent_position INT NOT NULL,
    syllable_accent_position_backwards INT NOT NULL,
    UNIQUE KEY (word)
);
