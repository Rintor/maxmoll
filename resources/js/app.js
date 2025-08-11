require('./bootstrap');

document.addEventListener("DOMContentLoaded", function () {
    let hideTimeout;
    let dropdownItems = [];

    function enableDropdownHover() {
        dropdownItems = document.querySelectorAll('.nav-item.dropdown');

        dropdownItems.forEach(function (item) {
            item.addEventListener('mouseenter', onMouseEnter);
            item.addEventListener('mouseleave', onMouseLeave);
        });
    }

    function disableDropdownHover() {
        dropdownItems.forEach(function (item) {
            item.removeEventListener('mouseenter', onMouseEnter);
            item.removeEventListener('mouseleave', onMouseLeave);
            item.classList.remove('show');
            const menu = item.querySelector('.dropdown-menu');
            if (menu) menu.classList.remove('show');
        });
        dropdownItems = [];
    }

    function onMouseEnter() {
        clearTimeout(hideTimeout);
        this.classList.add('show');
        const menu = this.querySelector('.dropdown-menu');
        if (menu) menu.classList.add('show');
    }

    function onMouseLeave() {
        const item = this;
        hideTimeout = setTimeout(function () {
            item.classList.remove('show');
            const menu = item.querySelector('.dropdown-menu');
            if (menu) menu.classList.remove('show');
        }, 200);
    }

    function checkScreenWidth() {
        if (window.innerWidth >= 768) {
            enableDropdownHover();
        } else {
            disableDropdownHover();
        }
    }

    checkScreenWidth();

    window.addEventListener('resize', checkScreenWidth);
});
