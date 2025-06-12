-- Explicite le nom de la base de données à utiliser pour exécuter les commandes SQL à suivre
USE `rimma_toDo`
;

 -- Ouvre une 'transaction' (tout le script qui suit est exécuté en entier, à la moindre erreur, tout est annulé. c'est très pratique !)
START TRANSACTION
;

-- Insère des données dans la table 'categorie'
INSERT INTO categorie (label, displayRank) VALUES
('Très important', 10),
('Important', 20),
('Peu important', 50);


-- Termine la transaction
-- (si _toutes_ les commandes à l'interieur de la 'transaction' se sont bien passé, c'est parfait; sinon, tout est annulé. c'est très pratique !)
COMMIT
;