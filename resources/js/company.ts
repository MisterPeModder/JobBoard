/**
 * The main script for the company pages.
 * 
 * @module company
 */

import * as imageInput from './components/imageInput';

function init() {
    imageInput.init();
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
