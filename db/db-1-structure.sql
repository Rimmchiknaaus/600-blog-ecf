USE `rimma_todo`
;

-- Crée la table 'users'
CREATE TABLE utilisateur (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,name VARCHAR(100) NOT NULL
    ,email VARCHAR(100) NOT NULL UNIQUE
    ,password VARCHAR(255) NOT NULL
    ,hashedPassword VARCHAR(255) NOT NULL

    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  COMMENT 'Date de création'
    ,updated_at TIMESTAMP NULL ON UPDATE NOW() COMMENT 'Date de dernière modification'
);


CREATE TABLE task (
    id INT PRIMARY KEY AUTO_INCREMENT
    ,idUtilisateur INT NOT NULL
    ,idCategorie INT NOT NULL
    ,name VARCHAR(255) NOT NULL
    ,description TEXT
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  COMMENT 'Date de création'
    ,updated_at TIMESTAMP NULL ON UPDATE NOW() COMMENT 'Date de dernière modification'
);

CREATE TABLE categorie (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,label VARCHAR(255) NOT NULL
    ,displayRank INT NOT NULL DEFAULT 50 
);


ALTER TABLE task

    ADD CONSTRAINT fk_task_utilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(id)
    ,ADD CONSTRAINT fk_task_categorie FOREIGN KEY (idCategorie) REFERENCES categorie(id)
;



