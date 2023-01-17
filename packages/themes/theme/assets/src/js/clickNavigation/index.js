window.addEventListener('DOMContentLoaded', (e) => {
    const navItems = document.querySelectorAll('header input');

    for (const navItem of navItems) {
        navItem.checked = false;
        navItem.addEventListener('change', (e) => {
            uncheckAllItemsExcept(e.target, navItems);
        })
    }

    function uncheckAllItemsExcept(target, items) {
        for(const item of items){
            if(item === target){
                continue;
            }
            item.checked = false;
        }
    }
});

