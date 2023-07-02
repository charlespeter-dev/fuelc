window.addEventListener('load', () => {
    document.querySelectorAll('iframe').forEach(el => {
        if (el.src) {
            if (el.src.indexOf('go.pardot.com' !== -1)) {
                el.src = el.src + window.location.search;
            }
        }
    });
});

