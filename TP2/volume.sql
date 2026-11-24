-- =====================================================================
-- volume.sql — Ajoute 20 000 étudiants fictifs et 120 000 notes (TP2, partie 4)
-- À exécuter sur VM1 :  sudo mariadb scolarite < volume.sql
-- Annulation        :  sudo mariadb scolarite < volume_annuler.sql
-- Utilise le moteur SEQUENCE de MariaDB (tables virtuelles seq_1_to_N).
-- =====================================================================
SET NAMES utf8mb4;
INSERT INTO etudiant (matricule, prenom, nom, filiere, email)
SELECT CONCAT('VX', LPAD(seq, 6, '0')), 'Fictif', CONCAT('VOLUME', seq),
       IF(seq % 2 = 0, 'II', 'RT'), CONCAT('vx', seq, '@esp.ucad.edu.sn')
FROM seq_1_to_20000;

INSERT INTO note (matricule, ec, valeur)
SELECT CONCAT('VX', LPAD(s.seq, 6, '0')), e.code, ROUND(RAND(s.seq * 7 + e.credits) * 80) / 4
FROM seq_1_to_20000 s CROSS JOIN ec e;

SELECT COUNT(*) AS etudiants FROM etudiant;
SELECT COUNT(*) AS notes FROM note;
