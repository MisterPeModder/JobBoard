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

export interface ModuleInitializer {
    (): void;
    initialized?: boolean;
}

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

/**
 * Registers a module initializer.
 * 
 * Initializers will automatically call themselves on DOM load,
 * but can be manually called.
 * 
 * @param initFn The function that will be executed to initilize the module.
 * @returns The module initializer function.
 */
export function initModule(initFn: () => void): ModuleInitializer {
    const wrapper: ModuleInitializer = function () {
        if ('initialized' in wrapper && wrapper.initialized === true)
            return;
        try {
            initFn();
        } finally {
            wrapper.initialized = true;
        }
    }
    document.addEventListener("DOMContentLoaded", wrapper);
    return wrapper;
}
