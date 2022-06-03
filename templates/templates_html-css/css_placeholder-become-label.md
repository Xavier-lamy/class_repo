# Transformer le placeholder en label quand on écirt dans le champ

```html
<div class="input-group">
  <input type="text" id="text-input-1" placeholder="Placeholder label">
  <label for="text-input-1">Placeholder label</label>
</div>


<!--If label is before the placeholder in HTML, for example in a plugin where labels position is set by plugin-->
<div class="input-group">
  <label for="text-input-2">Placeholder label</label>
  <input type="text" id="text-input-2" placeholder="Placeholder label">
</div>
```

```css
.input-group {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  margin: 1rem 0;
  position: relative;
}

input, label, ::placeholder {
  font-family: serif;
  color: black;
  font-size: 1rem;
}

input {
  border: 1px solid black;
  padding: 1rem;
}

label {
  position: absolute;
  margin-left: 0.8rem;
  padding: 0 0.2rem;
  opacity: 0;
}

/*Select label when placeholder is not visible: */
input:not(:placeholder-shown) + label {
  opacity: 1;
  transform: translateY(-.6rem);
  background-color: white;
  transition: transform .2s ease-in-out;
}
```

- Si le label n'est pas placé après le input dans le html (exemple si un plugin le place avant)
```js
//Only necessary if label is not placed after input in html
const moveLabelAfterInput = () => {
  let inputs = document.getElementsByTagName('input');

  for(const input of inputs){
    let inputId = input.getAttribute('id');
    let label = document.querySelector(`[for="${inputId}"]`);
 
    input.insertAdjacentElement('afterend', label);
  };
};
moveLabelAfterInput();
```