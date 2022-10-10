import * as exclusiveDetails from './components/exclusiveDetails';

/**
 * Initializes the companyList module.
 */
function init() {
    exclusiveDetails.init();
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
