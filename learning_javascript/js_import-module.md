# Modules JS
Pour importer/exporter des parties de code en JS, import ne suffit pas contrairement à php:

+ On définit quelles fonctions on veut exporter dans notre fichier de composants:
```js
//functions.js

//Soit on préfixe les fonctions à exporter
export const functionName = variable => {
    return variables;
}

//Soit on met nos fonctions et on indique lesquelles exporter
const functionName1 = variable => {
    return variables;
}

const functionName2 = variable => {
    return variables;
}

module.exports = {
    functionName1,
    functionName2,
}
```

+ Puis dans notre fichier principal:
```js
//app.js
import {    
    functionName1,
    functionName2,
} from './functions.js';
```