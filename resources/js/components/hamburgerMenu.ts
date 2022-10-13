/**
 * Powers the <x-hamburger-menu> component
 * 
 * @module hamburgerMenu
 */

import { initModule } from '../functional';

export function attachToggleButton(button: HTMLElement) {
    button.onclick = event => {
        toggle();
        event.preventDefault();
    };
}

export function toggle() {
    const menu = document.querySelector('#hamburger-menu');
    const background = document.querySelector('#hamburger-background');

    menu.classList.toggle('translate-x-full')
    if (background.classList.toggle('hidden')) {
        document.body.style.overflow = 'auto';
    } else {
        document.body.style.overflow = 'hidden';
    }
}

/**
 * Initializes the hamburgerMenu component module.
 */
export const init = initModule(() => {
    document.querySelectorAll('.hamburger-toggle').forEach(attachToggleButton);
});
