/** @module util Functional-style utility functions */

export function toggleClass(className: string): (elem: Element) => void {
    return (elem) => elem.classList.toggle(className);
}
