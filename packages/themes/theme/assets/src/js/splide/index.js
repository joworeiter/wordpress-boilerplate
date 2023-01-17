import Splide from '@splidejs/splide';

if( document.querySelector('#splide')){
    new Splide('#splide', {
        type: 'loop',
        perPage: 3,

        breakpoints: {
            1200: {
                perPage: 2,
            },
            992: {
                perPage: 1,
            }
        }
    }).mount();
}

if( document.querySelector('#block-quotes')){
    new Splide('#block-quotes', {
        type: 'loop',
        perPage: 1,
        autoplay: true,
        interval: 3000,
        pauseOnHover: true
    }).mount();
}
