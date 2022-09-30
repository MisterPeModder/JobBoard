/**
 * Functional-style utility functions.
 * 
 * @module functional
 */

export function toggleClass(className: string): (elem: Element) => void {
    return (elem) => elem.classList.toggle(className);
}

/**
 * Finds an element within the given element's parent chain.
 * 
 * @param element The starting element, is included in the search.
 * @param predicate The filter.
 * @returns The first matching element, or null if not found.
 */
export function findParent(element: Element, predicate: (parent: Element) => boolean): Element | null {
    for (let current = element; current != null; current = current.parentElement) {
        if (predicate(current))
            return current;
    }
    return null;
}

/**
 * @returns Strict equality predicate.
 */
export function sameAs(value: unknown): (other: unknown) => boolean {
    return (other) => other === value;
}
