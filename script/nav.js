
function splitAtRoot(path) {

    const url = new URL(path, window.location.origin);
    const pathFromRoot = url.pathname;
    return pathFromRoot;
}

function setNav(current_path) {

    current_path = splitAtRoot(current_path);

    fetch('/pages/nav.html')    // Leading slash make sure that path is from root for Github repo
        .then(r => r.text())
        .then(html => {

            document.getElementById('main-nav').innerHTML = html;       // Place the navigation HTML into <nav id="main-nav">

            const nav = document.getElementById('main-nav');

            for (let child of nav.children){

                const link = child.querySelector('a');

                if (link instanceof HTMLAnchorElement) {  // Continues if anchor element has link

                    const hrefPath = splitAtRoot(link.getAttribute('href'));  // Get the href path from root

                    if (hrefPath === current_path || (current_path.endsWith('/') && hrefPath.endsWith('index.html'))) {
                        link.classList.add('current_page'); // Highlight the current page link
                    }
                }
            }

        });
}

const current_path = window.location.pathname; // Get the current path
setNav(current_path);
