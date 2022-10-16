/**
 * Powers the <x-advert-options> component
 * 
 * @module advertOptions
 */

import { findParent, initModule } from '../functional';

type State = 'open' | 'closed' | 'opening' | 'closing';

class JobOptions {
    private dropdown: HTMLElement;
    private editItem: HTMLLinkElement;
    private deleteItem: HTMLFormElement;

    private currentButton: Element | null = null;

    public state: State = 'closed';

    constructor() {
        // wrap the dropdown HTML element and remove it from the DOM
        this.dropdown = document.querySelector('#advert-options-dropdown') as HTMLElement
        this.editItem = this.dropdown.querySelector('a#advert-options-edit');
        this.deleteItem = this.dropdown.querySelector('form#advert-options-delete');

        this.dropdown.classList.remove('animate-dropdown-open');
        this.dropdown.remove();

        // open the dropdown 
        document.querySelectorAll('.advert-options').forEach(button => {
            if (!this.can('update', button) && !this.can('delete', button)) {
                // if user cannot delete or edit the advert, hide the options menu
                button.classList.add('hidden');
                return;
            }

            button.addEventListener('click', event => {
                // if click is inside the dropdown, don't prevent the event
                if (findParent(event.target as Element, parent => parent.id === this.dropdown.id)) {
                    event.stopImmediatePropagation();
                    return;
                }
                if (this.openIn(button))
                    event.stopImmediatePropagation();
                event.preventDefault();
            });
        });

        // close the dropdown when open
        document.addEventListener('click', () => this.close());

        this.dropdown.addEventListener('animationcancel', () => this.onAnimationEnd());
        this.dropdown.addEventListener('animationend', () => this.onAnimationEnd());
    }

    /**
     * Opens the dropdown inside the given element.
     * 
     * @returns Whether the dropdown opened successfully.
     */
    openIn(element: Element): boolean {
        if ((this.state === 'open' || this.state === 'opening') && element === this.currentButton)
            return false;
        this.dropdown.remove();

        this.onOpenStart(element);

        element.appendChild(this.dropdown);
        this.dropdown.classList.remove('hidden');
        this.dropdown.classList.remove('animate-dropdown-close');
        this.state = 'opening'
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
        if (this.state === 'closed' || this.state === 'closing')
            return false;
        this.state = 'closing';
        this.dropdown.classList.remove('animate-dropdown-open');
        this.dropdown.classList.add('animate-dropdown-close');
        return true;
    }

    /**
     * Extracts the job advert id from the given advert element.
     * 
     * @param element The `<x-job-advert>` root element.
     * @returns The advert id, or null if not found.
     */
    private getAdvertId(element: Element): number | null {
        const match = element.id.match(/^advert-(\d+)-options$/);
        return match != null ? Number(match[1]) : null;
    }

    private onAnimationEnd() {
        if (this.state === 'opening')
            this.state = 'open'; // dropdown finished opening
        else if (this.state === 'closing') {
            this.state = 'closed'; // downdown finished closing
            this.onCloseFinish();
        }
    }

    /**
     * Called when the dropdown just stopped opening.
     */
    private onOpenStart(element: Element) {
        // hide the privileged actions by default
        this.editItem.classList.add('hidden');
        this.deleteItem.classList.add('hidden');

        const advertId = this.getAdvertId(element);
        if (advertId === null)
            return;

        if (this.can('update', element)) {
            // set the correct route link for advert editing
            this.editItem.href = this.editItem.href.replace(/\/\d+\/edit$/, `/${advertId}/edit`);
            this.editItem.classList.remove('hidden');
        }
        if (this.can('delete', element)) {
            // set the correct route link for advert deletion
            this.deleteItem.action = this.deleteItem.action.replace(/\/\d+$/, `/${advertId}`);
            this.deleteItem.classList.remove('hidden');
        }
    }

    /**
     * @returns Whether the user is permitted the perform this action
     * on the advert assigned to the given element.
     */
    private can(action: 'update' | 'delete', element: Element): boolean {
        return element.classList.contains(`can-${action}`);
    }

    /**
     * Called when the dropdown just stopped closing.
     */
    private onCloseFinish() {
        // remove self from DOM
        this.dropdown.remove();
    }
}

/**
 * The JobOptions instance.
 */
export let options: JobOptions | null = null;

/**
 * Initializes the advertOptions component module.
 */
export const init = initModule(() => {
    options = new JobOptions();
});
