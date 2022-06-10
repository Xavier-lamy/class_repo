# Fonction slugify

## Fonction slugify simple
- Exemple d'utilisation pour une url ou un id
```js

let stringToTest = 'À plus:/!;';
console.log(stringToTest); //Log: 'À plus:/!;'

const slugify = str => {
  
  let from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;"; //List all special characters which need to be transformed (like accents and special letters)
  let to = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------"; //List all characters for replacement 
  
  for (let i=0 ; i < from.length ; i++) {
    //Use replace with a new RexExp
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }
  
  str = str
      .trim() //Remove whitespace form beginning and end
      .replace(/[^\w\s-]/g, '') //Replace all characters which are not letters or numbers ( '\w' or 'a-zA-Z0-9' ), whitespace ( '\s' ) or '-', by an empty character (thus removing it)
      .replace(/[\s_-]+/g, '-') //Replace whitespace, underscore and hyphen by hyphen (if more than one , then it is replaced by only one hyphen)
      .replace(/^-+|-+$/g, ''); //Remove starting and ending hyphen
      .toLowerCase() //Change caps to lowercase
  
  return str;
  
}

let newString = slugify(stringToTest);


console.log(newString); //Log: 'a-plus'

```
+ Ici dans la boucle ``for`` on utilise une regex qui prend ``from`` en caractères à chercher et ``to`` en caractères de remplacement, ``charAt`` est une méthode qui permet de renvoyer le caractère situé à l'index donné en argument, donc ici on demande à chaque tour de boucle de remplacer le caractère de ``from`` par le caractère de ``to`` qui a le même index