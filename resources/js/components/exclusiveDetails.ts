/**
 * Powers the image-preview capabilities of the <x-exclusive-details> component.
 * 
 * @module exclusiveDetails
 */

import { differentFrom, initModule } from '../functional';

/**
 * Attach events to the given image input component.
 */
export function attach(details: HTMLDetailsElement, allDetails: HTMLDetailsElement[]) {
    details.addEventListener('toggle', () => {
        // when opening job details, close all other job details
        if (details.open) {
            allDetails
                .filter(differentFrom(details))
                .forEach(other => other.open = false);

            details.parentElement?.scrollIntoView({
                block: 'start',
                inline: 'nearest',
                behavior: 'smooth'
            });
        }
    });
}

export const init = initModule(() => {
    const allDetails = Array.from(document.querySelectorAll('details.exclusive')) as HTMLDetailsElement[];
    for (let details of allDetails) {
        attach(details, allDetails)
    }
});
