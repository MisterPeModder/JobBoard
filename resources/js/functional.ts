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

/** A function that tests its argument and returns a boolean. */
export type Predicate<T> = (value: T) => boolean;

/**
 * @returns Strict equality predicate.
 */
export function sameAs(value: unknown): Predicate<unknown> {
    return (other) => other === value;
}

/**
 * @returns Strict inequality predicate.
 */
export function differentFrom(value: unknown): Predicate<unknown> {
    return (other) => other !== value;
}
