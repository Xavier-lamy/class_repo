# L'Unicode et l'ASCII

## ASCII (American Standard Code for Information Interchange)
- Utilise *7 Bits* pour encoder *128 caractères* (Le 8ème est utilisé pour des vérifications)
- Certaines versions étendues utilisent le 8ème Bit pour porter à *256* le nombre de caractères soutenus (ex: ajout du `ç`)
- Ces caractères sont:
    - 0 : caractère nul
    - 1-31 : Caractères de commande (ex: sauts de ligne, tabulations)
    - 32-47: Caractères spéciaux (`` espace ! " # $ % & ' ( ) * + , - . / ``)
    - 48-57: Chiffres de 0 à 9
    - 58-64: Caractères spéciaux (`` : ; < = > ? @ ``)
    - 65-90: Lettres Majuscules
    - 91-96: Caractères spéciaux (`` [ \ ] ^ _ ` ``)
    - 97-122: Lettres Minuscules
    - 123-126: Caractères spéciaux (`` { | } ~ ``)
    - 127: Delete, permet de supprimer un caractère (en binaire 1111111)

## UTF-8 (8-Bit Universal Character Set Transformation Format)
- Dérive en partie de l'ASCII mais permet d'encoder beaucoup plus de caractères
- Les 128 premiers caractères sont les même que pour l'ASCII
- Il est composé de 17 *plans* dont ceux réellements utilisés:
    - Le **Basic Multilingual Plane** (plan 0) qui comprend: 
        - la plupart des systèmes d'écriture actuels,
        - les caractères de ponctuation et de contrôles (saut de ligne,...), 
        - les symboles
    - **Supplementary Multilingual Plane** (plan 1) : systèmes d’écriture historiques (rarement utilisés)
    - **Supplementary Ideographic Plane** (plan 2) : caractères chinois, japonais et coréens rares
    - **Supplementary Special-Purpose Plane** (plan 14) : caractères de contrôle individuels
    - **Supplementary Private Use Area – A** (plan 15) : utilisation privée
    - **Supplementary Private Use Area – B** (plan 16) : utilisation privée

## Codes UTF-8 utiles
| Caractère | ``Alt +`` |
|-----------|-----------|
| Â         | ``182 ``  |
| À         | ``183 ``  |
| Æ         | ``146 ``  |
| æ         | ``145 ``  |
| Ç         | ``128 ``  |
| É         | ``144 ``  |
| È         | ``212 ``  |
| Œ         | ``0140``  |
| œ         | ``0156``  |
| Ù         | ``235 ``  |
