require('./bootstrap');

const displayBadgeDetails = (badge_id) => {
    document.getElementById('badge' + badge_id ).classList.remove('d-none');
}

// HTML api History
const changePage = (event) => {
    let anchor = window.location.hash;

    if(!anchor) anchor = "#badges";

    if(anchor.split('&').length > 1) {
        let hash = anchor.split('&');
        let badge_id = hash[1].split('=')[1];

        displayBadgeDetails(badge_id);
    } else {
        // Hide all badges
        let badges = document.querySelectorAll('.badge-detail');
        for (let badge of badges) badge.classList.add('d-none');
        // Hide all pages
        let pages = document.querySelectorAll(".page");
        for (let page of pages) page.classList.add('d-none');
        // Show the selected one
        let currentPage = document.querySelector(anchor);
        currentPage.classList.remove('d-none');

        // remove "tab-selected" feedback on menu links
        let links = document.querySelectorAll("#tabs-bar > a");
        for (let link of links) link.classList.remove('tab-selected');
        // and add it to the current active one
        let currentLink = document.querySelector(`[href="${anchor}"]`);
        currentLink.classList.add('tab-selected');

        window.scrollTo(0, 0);
    }
}

window.addEventListener("hashchange", changePage);
changePage();