# Les positions
+ ``position: absolute;``: a utiliser que dans des cas tres precis, car l'élément peut se retrouver à chevaucher les autres:
	- Si un bloc est positionné en absolu dans un autre bloc lui-même positionné en absolu, fixe ou relatif, alors il se positionne en absolu par rapport à l'intérieur de ce bloc.
+ ``position: fixed;``: semblable à l'absolu, mais l'élément reste toujours visible meme quand on navigue dans la page, utile pour des menus qui doivent rester toujours apparents
+ ``position: relative;``: décale l'élément par rapport à sa position d'origine (le point 0,0 est le point supérieur gauche de l'élément):
+ On utilise les valeurs ``top``, ``bottom``, ``left`` et/ou ``right`` pour placer l'élément sur l'écran:
	- si on souhaite décaler de 20 pixel vers le haut il faut utiliser ``bottom`` (on ajoute 20px depuis le fond vers le haut), on utilise donc la direction opposée à celle voulue
+ Exemples:
```css
header
{
	position: absolute;
	top: 20px;
	left: 30px;
	z-index: 5;
}

footer
{
	position: fixed;
	bottom:0px;
	right:0px;
	width:120px;
}

ul
{
	position: relative;
	bottom: 10px;
}
```