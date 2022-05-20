# Note avec étoiles 
- Réaliser une note sur 10 représentée par des étoiles qui se colorent dynamiquement en fonction de la note:
- Méthode inspirée de la méthode 5 de cet [article](https://css-tricks.com/five-methods-for-five-star-ratings/)

```html
<!--Let suppose there is a php variable storing the note for a product, and another storing the scale (for example if some products are with a /20 note and other a /10-->
<!--Note: with only 5 stars this is better not to use that on a too high scale note (like a /100 would not render well)-->

<span class="rating-note"><?php echo $product_note . '/' . $note_scale; ?></span>
<div class="rating-stars" style="--rating: <?php echo $note_scale; ?>" aria-label="The product is rated <?php echo $product_note . 'on' . $note_scale; ?>"><!--The aria-label is not really needed if the note also have a text version like here, only if the stars are the only way to display the note-->

```

```scss

.rating-stars {
  $star-size: 20px;
  $star-empty: #d6d6d6; //Will display for the empty section of stars
  $star-full: #E9B23D; //Will display for the full section of stars 
  $percent: calc(var(--rating) / 10 * 100%); //here we use the css var(--varname) instead of scss variables, because we need to fetch the variable put in html style, note we could also use only css variables
  
  display: inline-block;
  font-size: $star-size;
  font-family: Times; // put a standard font-family to avoid stars being render not as expected by parent font-family
  line-height: 1;
  
  &::before {
    content: '★★★★★'; //use unicode stars
    letter-spacing: 3px;
    background: linear-gradient(90deg, $star-full $percent, $star-empty $percent);
    background-clip: text; //let the background clipping to the text only, that means the background will not be display outside of stars (which otherwise would not only be ugly, but also lead to some probems with the spacing between stars)
    -webkit-background-clip: text; //add compatibility for browsers support
    -webkit-text-fill-color: transparent;
  }
}
```