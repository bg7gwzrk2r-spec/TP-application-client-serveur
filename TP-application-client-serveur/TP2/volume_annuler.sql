-- Retire les données ajoutées par volume.sql
DELETE FROM note     WHERE matricule LIKE 'VX%';
DELETE FROM etudiant WHERE matricule LIKE 'VX%';
SELECT COUNT(*) AS notes FROM note;
