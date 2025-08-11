function showBtns() {
    document.querySelector("#btns-username").classList.add('btn-username-mobile');
    document.querySelector("#logo").classList.add('logo-mobile');
    document.querySelector("#ham-menu-icon-hide").style.display = 'flex';
    document.querySelector("#ham-menu-icon-show").style.display = 'none';
}

function hideBtns(){
    document.querySelector("#btns-username").classList.remove('btn-username-mobile');
    document.querySelector("#logo").classList.remove('logo-mobile');
    document.querySelector("#ham-menu-icon-hide").style.display = 'none';
    document.querySelector("#ham-menu-icon-show").style.display = 'flex';
}