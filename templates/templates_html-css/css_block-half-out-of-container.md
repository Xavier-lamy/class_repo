# Bloc sortant à moitié de son bloc parent

```html
<div class="overlap">
    <div class="overlap__inner">
        <!--content-->
    </div>
</div>    
```

```css
.overlap {
    /*Add margin on parent block to avoid overlapping unexpected content*/
    margin-top: calc(300px - 2%); /*can be changed either by fixed height, or even calculated in js*/
    overflow: initial; /*To let inner being able to go out of parent block*/
}
.overlap__inner {
    /*Add equivalent negative margin to inner block*/
    margin-top: calc(-300px + 2%);
}
```