document.addEventListener("DOMContentLoaded", function() {
    let hash = window.location.hash;
    
    if (hash) {
        let triggerEl = document.querySelector(`button[data-bs-target="${hash}"], a[href="${hash}"], button[aria-controls="${hash.replace('#', '')}"]`);
        
        if (triggerEl) {
            console.log("3. Przycisk znaleziony, wymuszam kliknięcie!");
            triggerEl.click();
        }
    }
});