function setNav() {
    fetch('pages/nav.html')
        .then(r => r.text())
        .then(html => {
            document.getElementById('main-nav').innerHTML = html;
        });
}