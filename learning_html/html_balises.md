# Les différentes balises HTML
Les balises orphelines sont représentées avec le ``/`` final pour les différencier des balises en pairs

## Balises de base
| Balise | Description |
|--------|-------------|
| ``<!DOCTYPE html>`` | Première balise |
| ``<html>`` | Balise principale |
| ``<head>`` | En-tête de page |
| ``<body>`` | Corps de la page |

## Balises d'en-tête
| Balise | Description |
|--------|-------------|
| ``<link />`` | Liaison avec la feuille de style |
| ``<meta />`` | Métadonnées de la page (charset, mots-clés,...) |
| ``<script>`` | Code Javascript |
| ``<style>`` | Code CSS |
| ``<title>`` | Titre de la page |

## Balises de structuration du texte
| Balise | Description |
|--------|-------------|
| ``<abbr>`` | Abréviation (peut prendre title= en attribut pour préciser) |
| ``<blockquote>`` | Citation longue (peut prendre cite="url" en attribut) |
| ``<cite>`` | Citation du titre d'une oeuvre ou d'un évènement |
| ``<q>`` | citation courte |
| ``<sup>`` | Exposant |
| ``<sub>`` | Indice |
| ``<strong>`` | Mise en valeur forte |
| ``<em>`` | Mise en valeur normale |
| ``<mark>`` | Mise en valeur visuelle |
| ``<del>`` | Texte barré |
| ``<h1>`` | Titre de niveau 1 |
| ``<h2>`` | Titre de niveau 2 |
| ``<h3>`` | Titre de niveau 3 |
| ``<h4>`` | Titre de niveau 4 |
| ``<h5>`` | Titre de niveau 5 |
| ``<h6>`` | Titre de niveau 6 |
| ``<img />`` | Image |
| ``<figure>`` | Figure (image, code) |
| ``<figcaption>`` | Description ou titre de la figure |
| ``<audio>`` | Son |
| ``<video>`` | Vidéo |
| ``<source>`` | Source pour les balises Son et Vidéo (quand on souhaite afficher plusieurs sources, ce que ne permet pas l'attribut ``src``) |
| ``<a>`` | Lien hypertexte |
| ``<br />`` | Retour à la ligne |
| ``<p>`` | Paragraphe |
| ``<hr />`` | Ligne de séparation horizontale (retour à la ligne et trace une ligne horizontale entre les deux parties) |
| ``<address>`` | Adresse de contact |
| ``<del>`` | Texte supprimé |
| ``<ins>`` | Texte Inséré |
| ``<dfn>`` | Définition |
| ``<kbd>`` | Saisie clavier |
| ``<pre>`` | Affichage formaté: pour les codes sources, permet d'afficher le texte tel qu'on le tape dans le code source, cela peut servir à afficher le code source brut sans qu'il soit utilisé ou à faire de l'ASCII art avec des lettres et caractères spéciaux (sans cette balise le code serait sur une ligne et il faudrait des balises ``<br/>`` pour aller à la ligne) |
| ``<progress>`` | Barre de progression |
| ``<time>`` | Date ou heure |

## Balises de listes
| Balise | Description |
|--------|-------------|
| ``<ul>`` | Liste à puces, non numérotée |
| ``<ol>`` | Liste numérotée |
| ``<li>`` | Elément de liste à puces |
| ``<dl>`` | Liste de définitions |
| ``<dt>`` | Terme à définir |
| ``<dd>`` | Définition du terme |

## Balises de tableau
| Balise | Description |
|--------|-------------|
| ``<table>`` | Tableau |
| ``<caption>`` | Titre du tableau |
| ``<tr>`` | Ligne du tableau |
| ``<th>`` | Cellule d'en-tête |
| ``<td>`` | Cellule |
| ``<thead>`` | Section d'en-tête |
| ``<tbody>`` | Corps du tableau |
| ``<tfoot>`` | Section de pied du tableau |

## Balises de formulaire
| Balise | Description |
|--------|-------------|
| ``<form>`` | Formulaire |
| ``<fieldset>`` | Groupe de champs |
| ``<legend>`` | Titre ou légende d'un groupe de champs |
| ``<label>`` | Libellé d'un champs |
| ``<input />`` | Champs de formulaire |
| ``<textarea>`` | Zone de saisie multiple |
| ``<select>`` | Liste déroulante |
| ``<option>`` | Elément d'une liste déroulante |
| ``<optgroup>`` | Groupe d'élements d'une liste déroulante |

## Balises sectionnantes
| Balise | Description |
|--------|-------------|
| ``<header>`` | En-tête |
| ``<nav>`` | Menu de navigation |
| ``<section>`` | Section de page |
| ``<article>`` | Article ou contenu autonome |
| ``<aside>`` | Informations complémentaires |
| ``<footer>`` | Pied de page |

## Balises génériques
Elles sont utiles si on leur ajoute des attributs, comme:
- class pour un nom de classe CSS
- id pour un nom unique à une balise
- style pour indiquer directement du code CSS à l'intérieur (non-recommandé)

| Balise | Description |
|--------|-------------|
| ``<divide>`` | Balise de type "block" |
| ``<span>`` | Balise de type "inline" |
