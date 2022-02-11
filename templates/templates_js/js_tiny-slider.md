# JS Tinyslider
```js
$(document).ready(function() {
  if($(".my-slider").length > 0) {
    var slider = tns({
      container: '.my-slider',
      autoplayTimeout: 7000,
      items: 4,
      gutter: 15,
      slideBy: 1,
      fixedWidth: false,
      center: false,
      loop: true,
      autoplay: true,
      speed: 300,
      axis: "horizontal",
      nav: false,
      controls: true,
      autoplayButtonOutput: false,
      lazyload: true,
      controlsContainer: "#custom-controls",
      controlsPosition: "bottom",
      responsive: {
        576: {
        },
        768: {
        },
        992: {
        },
        1200: {
        },
        1430: {
        }
      },
    });
  }
});
```
```html
<div class="slider-container">
    <ul class="controls" id="custom-controls" aria-label="Carousel Navigation">
        <li class="prev" data-controls="prev" aria-controls="customize">
            <img src="./img/left-arrow-black.svg" alt="Précédent">
        </li>
        <li class="next" data-controls="next" aria-controls="customize">
            <img src="./img/right-arrow-black.svg" alt="Suivant">
        </li>
    </ul>
    <div class="my-slider">
        <div class="slide">
            <div class="card">
                <img src="img/illustration.jpg" alt="img-title" class="card-img-top">
                <div class="card-body">
                    <a href="#" class="stretched-link">
                        <h4>Titre</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card">
                <img src="img/illustration.jpg" alt="img-title" class="card-img-top">
                <div class="card-body">
                    <a href="#" class="stretched-link">
                        <h4>Titre</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card">
                <img src="img/illustration.jpg" alt="img-title" class="card-img-top">
                <div class="card-body">
                    <a href="#" class="stretched-link">
                        <h4>Titre</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
```