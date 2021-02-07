
/* DOM Elements Object */
const DOMElements = {
    body: document.querySelector('body'),
    menuOpen: document.querySelector('.menu-open'),
    menu: document.querySelector('.menu'),
    menuClose: document.querySelector('.menu #close'),
    followBtn: document.querySelectorAll('.follow-btn'),
    followBtnAdd: document.querySelectorAll('.follow-btn #follow'),
    unFollowBtnAdd: document.querySelectorAll('.follow-btn #unFollow')
};
/* Menu Open Function */
DOMElements.menuOpen.addEventListener('click', () => {
    DOMElements.menu.style.right = '0';
    DOMElements.menu.style.visibility = 'visible';
    DOMElements.menu.setAttribute('aria-expanded', 'true');
    DOMElements.menu.classList.add('shown');
    DOMElements.body.style.overflow = 'hidden';
});
/* Menu Close Function */
DOMElements.menuClose.addEventListener('click', () => {
    DOMElements.menu.style.right = '-500px';
    DOMElements.menu.style.visibility = 'hidden';
    DOMElements.menu.setAttribute('aria-expanded', 'false');
    DOMElements.menu.classList.remove('shown');
    DOMElements.body.style.overflow = 'auto';
});

/* HomePage Banner Carousel */
$('.banner-slider .owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    autoplay: true,
    autoplayTimeout: 4000,
    nav: false,
    smartSpeed: 1000,
    items: 1,
    rtl: true
});

/* Follow Btn Toggle */
if (window.location.href.indexOf('categories') > -1 || window.location.href.indexOf('recipe-page') > -1) {
    $(DOMElements.followBtn).on('click', function () {
        // console.log(this.classList.contains('not-followed'));
        if ($(this).hasClass('not-followed')) {
            $(this).children('svg#follow').toggle();
            $(this).children('svg#unFollow').toggle();
        }
    });
    // 00971505519059
}

/* Categories Page Most Recent Chefs Carousel */
$('.most-recent .owl-carousel').owlCarousel({
    margin: 15,
    stagePadding: 10,
    nav: true,
    dots: false,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>'
    ],
    rtl: true,
    responsive: {
        0: {
            items: 1
        },
        410: {
            items: 2
        },
        767: {
            items: 3
        },
        991: {
            items: 4
        }
    }
});

/* Categories Page Categories Carousel */
$('.all-categories .owl-carousel').owlCarousel({
    margin: 10,
    nav: false,
    rtl: true,
    dots: false,
    navText: ['▶', '◀'],
    autoWidth: true,
});

/* Recipe Page Similar Recipes Carousel */
$('.similar-recipes .owl-carousel').owlCarousel({
    margin: 15,
    stagePadding: 10,
    nav: true,
    dots: true,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>'
    ],
    rtl: true,
    responsive: {
        0: {
            items: 1
        },
        410: {
            items: 2
        },
        767: {
            items: 3
        },
        991: {
            items: 4
        }
    }
});
basicAccount = true;
partnerAccount = false;


$('#basic-btn').click(function (e) {
    e.preventDefault();

    $('#partner').slideUp();
    $('#basic').slideDown();

});


$('#partner-btn').click(function (e) {
    e.preventDefault();

    $('#basic').slideUp();
    $('#partner').slideDown();

});

/* Register Page */
function showRegister(type) {
    if (type === 'basic') {
        $('#partner').slideUp();
        $('#basic').slideDown();
    } else if (type === 'partner') {
        $('#basic').slideUp();
        $('#partner').slideDown();
    }
}

/* Basic Profile Sub Menu */
function collapse(target) {
    let tarEl = $(`#${target}`);
    tarEl.parent().children().not(tarEl).slideUp();
    tarEl.slideDown();
}
