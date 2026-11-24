# TP2 — Architectures 2-tiers et 3-tiers comparées

Binôme : Ramatoulaye DIOP et Néné BA. Rapport complet avec captures : `rapport_TP2.pdf`.

## Contenu
- `rapport_TP2.pdf` : compte rendu
- `client_lourd.py` : application 2-tiers (Python + pymysql)
- `app3tiers/` : application 3-tiers PHP (`index.php`, `classement.php`, `releve.php`, `style.css`, `inc/`)
- `scolarite.sql`, `utilisateurs_tp1.sql` : base et comptes de consultation (repris du TP1)
- `utilisateurs_tp2.sql` : compte `app_scolarite` (limité à VM2)
- `volume.sql`, `volume_annuler.sql` : ajout et retrait de 20 000 étudiants / 120 000 notes

## Environnement
Windows 192.168.56.1, VM1 192.168.56.103 (MariaDB), VM2 192.168.56.105 (Apache + PHP). Adresses du kit remplacées dans `client_lourd.py`, `inc/config.php` et `utilisateurs_tp2.sql`.

## Test
```bash
# VM1
sudo mariadb < scolarite.sql && sudo mariadb < utilisateurs_tp1.sql && sudo mariadb < utilisateurs_tp2.sql
# 2-tiers (poste client)
python client_lourd.py
# 3-tiers (VM2)
sudo cp -r app3tiers /var/www/html/scolarite   # puis http://192.168.56.105/scolarite/
```

## Réponses
1. Présentation (`print`/`input`), logique métier (`moyenne()`, seuil, tri, admis), accès aux données (`pymysql`, `cur.execute`) : tout s'exécute sur le poste client.
2. Le fichier contient adresse, port, base, compte et mot de passe : on peut lire toute la base avec un autre client.
3. Python, pymysql et le programme (avec le mot de passe) sur chacun des 300 postes, à redéployer à chaque évolution.
4. Résultats identiques (10,75 VALIDÉ ; 18/30 admis) : indispensable pour que seule l'architecture change.
5. Un simple navigateur en 3-tiers ; tout le logiciel est installé une seule fois sur VM2.
6. Corps vide : PHP exécute `config.php` au lieu de l'envoyer ; le mot de passe reste sur VM2.
7. 3-tiers : un seul compte (`app_scolarite`) ; 2-tiers : un compte par utilisateur ou un compte partagé.
8. Le navigateur ne reçoit que du HTML : ni SQL, ni formule, ni identifiants.
9. ESP260011 : VALIDÉ en v1.0 (Windows), NON VALIDÉ en v1.1 (VM2, MAT = 7,50 < 8) ; 18/30 contre 16/30 admis : incohérence entre postes.
10. 3-tiers : un fichier (`metier.php`), une machine ; tous les utilisateurs en profitent au rechargement.
11. 2-tiers : `releve()` et `classement()` à modifier sur chaque poste ; 3-tiers : `releve()` et la requête du bilan, en un seul fichier.
12. 2-tiers : 120 180 lignes (2 407,3 Kio) rapatriées ; 3-tiers : 10 lignes et une page HTML de quelques Kio. L'écart vient du lieu du calcul.
13. `Bytes_sent` = octets envoyés par le serveur sur la connexion ; mesure honnête car comptée par le serveur.
14. Après le pare-feu (3306 autorisé seulement depuis VM2) : le 2-tiers échoue, le 3-tiers fonctionne. Impossible en 2-tiers car chaque poste doit joindre la base.
15. Mot de passe distribué avec le programme ; règles exécutées sur des postes non contrôlés ; trafic SQL en clair entre chaque poste et la base.
16. 2-tiers acceptable pour peu de postes, réseau de confiance, utilisateurs habilités ; 3-tiers pour la scolarité de toute l'université (une copie des règles, déploiement unique, pas d'accès direct à la base).
