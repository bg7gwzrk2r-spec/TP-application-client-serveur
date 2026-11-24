# TP1 — Le modèle client-serveur

Binôme : Ramatoulaye DIOP et Néné BA. Rapport complet avec captures : `rapport_TP1.pdf`.

## Contenu
- `rapport_TP1.pdf` : compte rendu
- `scolarite.sql` : création de la base `scolarite`
- `utilisateurs_tp1.sql` : comptes distants `etudiant` et `secretariat` (adresses adaptées au réseau 192.168.50.0/24 pour notre environnement)
- `index.html` : page servie par Apache sur VM1

## Test
```bash
sudo mariadb < scolarite.sql
sudo mariadb < utilisateurs_tp1.sql
sudo cp index.html /var/www/html/
```

## Environnement
Windows 192.168.50.100 (client), VM1 192.168.50.1 (MariaDB :3306 et Apache :80), VM2 (client).

## Réponses
1. 30 étudiants, 6 EC, 180 notes. Tables `filiere`, `etudiant`, `ec`, `note` ; clés étrangères : etudiant.filiere, note.matricule, note.ec.
2. Non : `mariadbd` (serveur, PID 1270, lancé au démarrage) et `mariadb` (client, PID 5355, lancé depuis un terminal) sont deux processus distincts.
3. 10061 = connexion refusée : VM1 joignable, MariaDB en marche mais n'écoutant que sur 127.0.0.1.
4. 127.0.0.1 : connexions locales seulement ; 0.0.0.0 : toutes les interfaces. Ubuntu choisit 127.0.0.1 par sécurité.
5. `USER()` = identité présentée par le client (etudiant@192.168.50.100) ; `CURRENT_USER()` = compte retenu par le serveur (etudiant@192.168.50.%).
6. Aucun : root n'existe que pour localhost ; accès refusé depuis Windows, ce qui protège le compte le plus puissant.
7. Deux connexions distantes ; les ports sources sont éphémères, choisis par l'OS du client ; 3306 est le port d'écoute fixe du serveur.
8. Erreur 1142 pour les actions non autorisées. Les droits sont stockés et vérifiés par le serveur : la sécurité repose sur lui (moindre privilège).
9. Oui : une seule copie des données sur VM1, donc pas de synchronisation.
10. Requête `GET / HTTP/1.1` + en-têtes (Host, User-Agent, Accept) ; réponse `HTTP/1.1 200 OK` + en-têtes + corps HTML.
11. `access.log` : IP du client, date, requête, code, taille, User-Agent.
12. L'OS remet le segment selon le port de destination (3306 → mariadbd, 80 → apache2). Le client doit connaître l'adresse (machine) et le port (programme).
13. Connexion persistante : authentification unique mais ressources occupées. HTTP sans état : montée en charge facile mais identité à renvoyer ; on utilise un cookie de session.
14. Les deux clients perdent le service : point unique de défaillance (SPOF).
15. Requête et résultats lisibles en clair ; le mot de passe n'apparaît pas en clair (empreinte). Solution : TLS/SSL, tunnel SSH ou VPN.
16. Voir la définition et les avantages/inconvénients dans `rapport_TP1.pdf` (centralisation et cohérence ; SPOF et trafic en clair).
