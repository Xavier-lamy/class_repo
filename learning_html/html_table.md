# Les tableaux HTML
```html
<table><!--balise pour définir qu'on est dans un tableau-->
	<caption>Identités</caption><!--balise pour le titre du tableau-->
	<thead><!--balise pour définir une en-tête de tableau-->
		<tr><!--balise pour définir une ligne de tableau-->
			<th>Nom</th><!--balise pour définir la première ligne du tableau (avec la légende pour les valeurs du tableau, apparait en gras par défaut, mais peut bien entendu etre modifié-->
			<th>Âge</th>
			<th>Nationalité</th>
		</tr>
	</thead>
	<tfoot><!--balise pour un pied de pâge du tableau, il permet pour les grands tableaux de répéter la légende également en bas, pour une meilleure visibilité, par convention on l'écrit entre l'en-tête et le corps du tableau, il apparaitra quand même à la fin -->
		<tr>
			<th>Nom</th>
			<th>Âge</th>
			<th>Nationalité</th>
		</tr>
	</tfoot>
	<tbody><!--balise pour le corps du tableau, les balises de sections de tableau: thead, tfoot et tbody ne sont pas indispensables mais sont utiles pour les grand tableaux par exemple-->
		<tr>
			<td>Jean</td><!--balise pour définir une cellule de tableau, à mettre à l'intérieur d'une ligne-->
			<td>20 ans</td>
			<td>Français</td>
		</tr>
		<tr>
			<td>John</td>
			<td>26 ans</td>
			<td>Anglais</td>
		</tr>
		<tr>
			<td>Martha</td>
			<td>37 ans</td>
			<td>Américaine</td>
		</tr>
	</tbody>
</table>
<table>
	<caption>tableau2</caption>
	<thead>
		<tr>
			<th>légende1</th>
			<th>légende2</th>
			<th>légende3</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>légende1</th>
			<th>légende2</th>
			<th>légende3</th>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td>A</td>
			<td>B</td>
			<td rowspan="2">C</td>
		</tr>
		<tr>
			<td>A</td>
			<td>B</td>
		</tr>
		<tr>
			<td>A</td>
			<td colspan="2">B et C</td>
		</tr>
	</tbody>
</table>
```
- l'attribut ``rowspan`` permet de fusionner des cellules en ligne, dans un tableau ou chaque ligne contient 3 cellules par exemple, on choisit 1 ligne ou il y aura 3 cellules dont une avec ``rowspan=2``, la ligne d'après ne contiendra que 2cellules, la 3eme sera celle fusionné dans la ligne du dessus
- l'attribut ``colspan`` permet de fusionner des cellules en colonne, dans un tableau ou chaque ligne contient 3 cellules par exemple on ne met que 2 cellules dans une des ligne et l'une des deux sera la fusion de deux cellules grâce a ``colspan=2``