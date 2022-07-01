# Créer un tableau responsive HTML/CSS avec les attributs ``data-``
- [version fonctionnelle](https://codepen.io/Xavier_xl/pen/wvmBVOm)

```html
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Age</th>
      <th>Job</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-head="Name">Matthew Lawe</td>
      <td data-head="Age">Immortal</td>
      <td data-head="Job">Sailor</td>
    </tr>
    <tr>
      <td data-head="Name">Horatio Nelson</td>
      <td data-head="Age">1758-1805 (47 years old)</td>
      <td data-head="Job">Admiral</td>
    </tr>
    <tr>
      <td data-head="Name">Nicholas Monsarrat</td>
      <td data-head="Age">1910-1979 (69 years old)</td>
      <td data-head="Job">Novelist</td>
    </tr>
  </tbody>
</table>
```

```css
/*Desktop*/
table {
  border-collapse: collapse;
}

td, th {
  border: 1px solid black;
  padding: 1rem;
}



/*Mobile*/
@media (max-width: 480px) {
  thead {
      display: none;
  }
  tbody tr {
    display: flex;
    flex-direction: column;
    margin: 1rem 0;
  }
  tbody tr td {
    display: flex;
    justify-content: space-between;
  }
  tbody tr td::before {
     content: attr(data-head) ' :';
     font-weight: 700;
     padding-right: .8em;
  }
}
```


