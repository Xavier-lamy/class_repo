# Tooltip
```scss
.tooltip {
    &_container {
        position: relative;
        &:hover {
            cursor: pointer;
            .tooltip_text {
                visibility: visible;
            }
        }    
        &:after {
            content: "";
            position:absolute;
            
            /* position tooltip correctly */
            right: 50%;
           
            /* vertically center */
            bottom: 1.6rem;
            transform:translateY(-50%);
           
            /* the arrow */
            border: .5rem solid $secondary-fade;
            border-color: $secondary-fade transparent transparent transparent;
            
            display:none; 
        }
        &:hover:after {
            display:block;
        }
    }
    &_text {
        visibility: hidden;
        width: fit-content;
        box-shadow: .2rem .2rem .3rem $dark-fade;
        background-color: $background;
        border: .05rem solid $secondary;
        text-align: center;
        line-height: 1.3rem;
        border-radius: $border-radius;
        position: absolute;
        z-index: 1;
        bottom: 3.1rem;
        right: 25%;
    }
}
```