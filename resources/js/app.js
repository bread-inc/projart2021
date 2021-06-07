require('./bootstrap');

// Profile page switch tabs
let switchTab = document.getElementById('tabs-bar');
if(switchTab != null) {
    let btnBadges = document.getElementById('btn-badges');
    let btnFavorites = document.getElementById('btn-favorites');
    let btnScores = document.getElementById('btn-scores');

    btnBadges.addEventListener('click', evt => {
        evt.preventDefault();
        btnBadges.classList.add("tab-selected");
        btnFavorites.classList.remove("tab-selected");
        btnScores.classList.remove("tab-selected");
    });

    btnFavorites.addEventListener('click', evt => {
        evt.preventDefault();
        btnFavorites.classList.add("tab-selected");
        btnBadges.classList.remove("tab-selected");
        btnScores.classList.remove("tab-selected");
    });

    btnScores.addEventListener('click', evt => {
        evt.preventDefault();
        btnScores.classList.add("tab-selected");
        btnFavorites.classList.remove("tab-selected");
        btnBadges.classList.remove("tab-selected");
    });
}