import { findParent, sameAs } from './functional';
import * as exclusiveDetails from './components/exclusiveDetails';

class JobOptions {
    private dropdown: HTMLElement;
    private currentButton: Element | null = null;

    constructor() {
        // wrap the dropdown HTML element and remove it from the DOM
        this.dropdown = document.querySelector('#advert-options-dropdown') as HTMLElement
        this.dropdown.classList.remove('animate-dropdown-open');
        this.dropdown.remove();

        // open the dropdown 
        document.querySelectorAll('.advert-options').forEach(button => {
            button.addEventListener('click', event => {
                // if click is inside the dropdown, don't do anything
                if (findParent(event.target as Element, sameAs(this.dropdown)))
                    return;
                if (this.openIn(button))
                    event.stopImmediatePropagation();
                event.preventDefault();
            });
        });

        // close the dropdown when open
        document.addEventListener('click', () => this.close());
    }

    /**
     * @returns Whether the dropdown is open, or null when it is opening or closing.
     */
    isOpen(): boolean | null {
        const opacity = Number(getComputedStyle(this.dropdown).opacity);
        if (opacity >= 1)
            return true;
        else if (opacity <= 0)
            return false;
        return null;
    }

    /**
     * Opens the dropdown inside the given element.
     * 
     * @returns Whether the dropdown opened successfully.
     */
    openIn(element: Element): boolean {
        if (this.isOpen() === true && element === this.currentButton)
            return false;
        this.dropdown.remove();
        element.appendChild(this.dropdown);
        this.dropdown.classList.remove('hidden');
        this.dropdown.classList.remove('animate-dropdown-close');
        this.dropdown.classList.add('animate-dropdown-open');
        this.currentButton = element;
        return true;
    }

    /**
     * Closes the dropdown.
     * 
     * @returns Whether the dropdown closed successfully.
     */
    close(): boolean {
        if (this.isOpen() === false)
            return false;
        this.dropdown.classList.remove('animate-dropdown-open');
        this.dropdown.classList.add('animate-dropdown-close');
        return true;
    }
}

/**
 * The JobOptions instance.
 */
export let options: JobOptions | null = null;

/**
 * Initializes the jobAdverts module.
 */
function init() {
    options = new JobOptions();
    exclusiveDetails.init();
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
