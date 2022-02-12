# Lien animé au survol

```scss
/*Animated Underline when hovering*/          
a { 
    display: inline-block;  
    position: relative; 
    text-decoration: none;
    &:after {
        content: '';  
        position: absolute;  
        width: 100%;
        transform: scaleX(0);  
        height: 0.1em; 
        bottom: 0; 
        left: 0; 
        background-color: $text;  
        transform-origin: bottom right;  
        transition: transform 0.3s ease-out; 
    } 
    &:hover:after {
        transform: scaleX(1);  
        transform-origin: bottom left;  
    }  
}  
```