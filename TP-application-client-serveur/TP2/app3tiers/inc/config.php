<?php
// inc/config.php — Paramètres de connexion à la base (TIER 3).
// Ce fichier reste sur le SERVEUR D'APPLICATION (VM2) : les clients ne le voient jamais.
// Requis par Apache, il est EXÉCUTÉ (et ne produit aucune sortie) : son contenu n'est jamais envoyé.
const BDD_HOTE = '192.168.56.11';
const BDD_BASE = 'scolarite';
const BDD_UTILISATEUR = 'app_scolarite';
const BDD_MOT_DE_PASSE = 'AppScol@2026';
