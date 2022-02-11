# Pattern for a striped table
+ be sure to check ``$color`` variables are defined
```scss
.table {
    table-layout: fixed;
    border-collapse: collapse;
    &--striped {
        @extend .table;
        th {
            padding: .25rem 0rem;
        }
        tr:nth-child(even){
            background-color: $light-fade;
        }
        tr:hover, tr:active {
            background-color: $secondary-fade;
        }
    }
}
```

```html
<table class="table--striped">
    <thead class="w--100 bg--secondary text--light">
        <th class="w--25">Title1</th>
        <th class="w--25">Title2</th>
        <th class="w--25">Title3</th>
        <th class="w--25">Title4</th>
    </thead>
    <tbody>
        <tr>
            <td>Content1</td>
            <td>Content2</td>
            <td>Content3</td>
            <td>Content4</td>
        </tr>
    </tbody>
</table>
```