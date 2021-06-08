require('./bootstrap');

// HTML api History
const changePage = (event) => {
    let anchor = window.location.hash;

    if(!anchor) anchor ="#badges";

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

window.addEventListener("hashchange", changePage);
changePage();