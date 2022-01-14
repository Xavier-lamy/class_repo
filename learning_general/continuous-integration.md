# L'intégration continue

Elle consiste à intégrer automatiquement la phase de tests unitaires au flux de déploiement, c'est à dire qu'à chaque nouvel ajout de fonctionnalités on lance automatiquement les tests pour vérifier que tout fonctionne:
- Avec un projet versionné (gitHub, gitLab) le push sera annulé si les tests ne sont pas tous validés et les dev seront informés de l'erreur, afin de la corriger
    - On peut utiliser git hub actions cumulé avec des test unitaires
    - ou on peut faire des hook gits on peut faire un script pour vérifier avant un commit pour vérifier que tout est bon
