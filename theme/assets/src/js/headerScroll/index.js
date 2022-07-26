window.onscroll = function() {
    scrollFunction()
};

const header = document.getElementsByTagName('header');

function scrollFunction() {
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        header[0].classList.add('fixedBar');
    } else {
        header[0].classList.remove('fixedBar');
    }
}
