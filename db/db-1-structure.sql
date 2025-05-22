
DROP DATABASE IF EXISTS `blog-lang`
;

-- Crée la base de données
-- /!\ penser à remplacer 'GRA' par _son_ 'trigramme' !
-- NOTE le caractère ` (aka: back-tick) doit être utilisé car le nom de la base de données commence par des chiffres et contient des caractères spéciaux tels que -
CREATE DATABASE IF NOT EXISTS `blog-lang`
;

-- [OPTIONAL !] Cette section n'est absolument pas requise.
-- [NOTE] Mais quand on va 'connecter' le PHP avec la BDD, ça va prendre beaucoup + de sens...
-- 
-- Crée un compte 'applicatif'.
-- Ce compte représente tout ce que qu'a droit de faire le 'site web' avec la 'base de données'.
-- Le but est de donner le moins de droits possibles à ce compte, donc à tous les Utilisateurs du 'site web'.
DROP USER IF EXISTS 'blog-lang-web-user'@'localhost'
;
CREATE USER 'blog-lang-web-user'@'localhost' IDENTIFIED BY 'Test13_Test13_'
;
--
-- Restreint au maximum les capacités (les droits) du compte 'applicatif'.
-- Le 'compte applicatif' n'a le droit que de lire, écrire, modifer, supprimer, et rien de +. (pas de création de table, ni de destruction de table par exemple)
GRANT SELECT, INSERT, UPDATE, DELETE ON `blog-lang`.* TO 'blog-lang-web-user'@'localhost'
;

-- Mentionne le nom de la base de données à utiliser pour exécuter les commandes SQL qui suivent
-- (oui, il peut y avoir plusieurs bases de données sur le même serveur de base de données !)
-- /!\ penser à remplacer 'GRA' par _son_ 'trigramme' !
-- NOTE le caractère ` (aka: back-tick) doit être utilisé car le nom de la base de données commence par des chiffres et contient des caractères spéciaux tels que -
USE `blog-lang`
;

-- Crée la table 'users'
CREATE TABLE user (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,name VARCHAR(100) NOT NULL
    ,email VARCHAR(100) NOT NULL UNIQUE
    ,password VARCHAR(255) NOT NULL
    ,hashedPassword VARCHAR(255) NOT NULL
    ,role VARCHAR(20) DEFAULT 'user'
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  COMMENT 'Date de création'
    ,updated_at TIMESTAMP NULL ON UPDATE NOW() COMMENT 'Date de dernière modification'
);

CREATE TABLE article (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,idUser INT NOT NULL
    --,lang INT NOT NULL
    ,en_titre VARCHAR(225) NULL
    ,en_contenu TEXT NULL
    ,fr_titre VARCHAR(225) NULL
    ,fr_contenu TEXT NULL
    ,image VARCHAR(100) NOT NULL
    ,fichier  VARCHAR(100) NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  COMMENT 'Date de création'
    ,updated_at TIMESTAMP NULL ON UPDATE NOW() COMMENT 'Date de dernière modification'
);

CREATE TABLE categorie (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,label VARCHAR(255) NOT NULL
);

CREATE TABLE commentaire (
     id INT AUTO_INCREMENT PRIMARY KEY
    ,idArticle INT NOT NULL
    ,idUser INT NOT NULL
    ,contenu TEXT NOT NULL
    ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  COMMENT 'Date de création'
    ,updated_at TIMESTAMP NULL ON UPDATE NOW() COMMENT 'Date de dernière modification'
);

CREATE TABLE article_categorie (
     idArticle INT NOT NULL
    ,idCategorie INT NOT NULL
);

ALTER TABLE article

    ADD CONSTRAINT fk_article_user FOREIGN KEY (idUser) REFERENCES user(id)
;
ALTER TABLE commentaire

    ADD CONSTRAINT fk_commentaire_user FOREIGN KEY (idUser) REFERENCES user(id)
    ,ADD CONSTRAINT fk_commentaire_article FOREIGN KEY(idArticle) REFERENCES article(id)
;



ALTER TABLE article_categorie
     ADD CONSTRAINT fk_article_categorie_article FOREIGN KEY(idArticle) REFERENCES article(id)
    ,ADD CONSTRAINT fk_article_categorie_categorie FOREIGN KEY(idCategorie) REFERENCES categorie(id)
;
