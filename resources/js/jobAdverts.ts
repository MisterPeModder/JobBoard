// /** The job options dropdown instance, only one exists */
let optionsDropdown: HTMLElement | null = null;

function isDropdownOpen(): boolean | null {
    const opacity = Number(getComputedStyle(optionsDropdown).opacity);
    if (opacity >= 1)
        return true;
    else if (opacity <= 0)
        return false;
    return null;
}

function openDropdownIn(element: Element): boolean {
    if (isDropdownOpen() === true)
        return false;
    optionsDropdown.remove();
    element.appendChild(optionsDropdown);
    optionsDropdown.classList.remove('hidden');
    optionsDropdown.classList.remove('animate-dropdown-close');
    optionsDropdown.classList.add('animate-dropdown-open');
    return true;
}

function closeDropdown() {
    if (isDropdownOpen() === false)
        return;
    optionsDropdown.classList.remove('animate-dropdown-open');
    optionsDropdown.classList.add('animate-dropdown-close');
}

export function init() {
    optionsDropdown = document.querySelector('#advert-options-dropdown') as HTMLElement;
    optionsDropdown.classList.remove('animate-dropdown-open');
    optionsDropdown.remove();

    // open the dropdown 
    document.querySelectorAll('.advert-options').forEach(options => {
        options.addEventListener('click', event => {
            if (openDropdownIn(options))
                event.stopImmediatePropagation();
            event.preventDefault();
        });
    });

    // close the dropdown when open
    document.addEventListener('click', () => {
        closeDropdown();
    });
}
