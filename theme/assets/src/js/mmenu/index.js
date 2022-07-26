import 'mmenu-js';

document.addEventListener(
    "DOMContentLoaded", () => {
        const menu = document.getElementById('menu');
        const mobileBtn = document.getElementsByClassName('menu');
        if (menu) {

            menu.classList.remove('d-none');

            new Mmenu("#menu", {
                    hooks: {
                        "close:start": (panel) => {
                            mobileBtn[0].classList.remove('opened');
                        }
                    },
                    "extensions": [
                        "pagedim-black",
                        "position-right"
                    ],
                    "title": "RVR",
                    "iconPanels": false,
                    "navbars": [ {
                        "position": "bottom",
                        "content": [
                            "<p>HPHDL - Deine Vertretung</p>"
                        ]
                    }],
                }, //config
                {
                    offCanvas: {
                        page: {
                            selector: '#rvr-page'
                        }
                    }
                }
            );


        }
    }
);