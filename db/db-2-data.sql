-- Explicite le nom de la base de données à utiliser pour exécuter les commandes SQL à suivre
USE `rimma_blog`
;

 -- Ouvre une 'transaction' (tout le script qui suit est exécuté en entier, à la moindre erreur, tout est annulé. c'est très pratique !)
START TRANSACTION
;

-- Insère des données dans la table 'categorie'
INSERT INTO categorie (id, label) VALUES

     (110, 'Bitcoin')
    ,(120, 'Testnets')
    ,(130, 'NFTs')
    ,(140, 'Defi')
    ,(150, 'Airdrops')
;


-- Termine la transaction
-- (si _toutes_ les commandes à l'interieur de la 'transaction' se sont bien passé, c'est parfait; sinon, tout est annulé. c'est très pratique !)
COMMIT
;