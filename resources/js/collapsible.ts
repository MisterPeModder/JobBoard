import { toggleClass } from "./functional";

export function init() {
    document.querySelectorAll('.collapsible-button').forEach(element => {
        element.addEventListener('click', () => {
            element.parentElement
                ?.querySelectorAll('.collapsible-content, .collapsible-button')
                .forEach(toggleClass('hidden'));
        });
    });

    // TEMPORARY: expands the first advert, used for testing
    document.querySelector('.collapsible')
        ?.querySelectorAll('.collapsible-content, .collapsible-button')
        .forEach(toggleClass('hidden'));
}
