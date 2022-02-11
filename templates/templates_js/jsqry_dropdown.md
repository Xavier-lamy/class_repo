## Dropdown jQuery
```js
$(document).ready(function() { //uniquement en début de document

//Custom dropdown for table of content
    $(".dropdown-header").on('click', function(){

        $(this).toggleClass('dropdown-close');
            
        if($('.dropdown-body').hasClass('dropdown-close')){
            $('.dropdown-body').removeClass('dropdown-close');
        } else {
            $('.dropdown-body').addClass('dropdown-close');
        }

        //change le sens de l'icone toggle
        if($('.dropdown-toggle').hasClass('toggle-reverse')){
            $('.dropdown-toggle').removeClass('toggle-reverse');
        } else {
            $('.dropdown-toggle').addClass('toggle-reverse');
        }

        });
    });
```