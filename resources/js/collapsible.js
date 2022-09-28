const CONTAINER = '.collapsible';
const CONTAINER_CLOSED = 'collapsible-closed';
const CONTENT = '.collapsible-content';
const OPEN_BUTTON = '.collapsible-open';
const CLOSE_BUTTON = '.collapsible-close';


/**
 * 
 * @param {HTMLElement} Base 
 */
function Collapsible(Base) {
    return class Test extends Base {
        isOpen() {
            const t = this;
            return !this.classList.contains(CONTAINER_CLOSED);
        }
    }
}

export function init() {
    document.querySelectorAll(CONTAINER).forEach(collapsible => {
        Object.assign(collapsible, {
            isOpen() {
                return !this.classList.contains(CONTAINER_CLOSED);
            },
            close() {

            },
            toggle() {
                if (this.isOpen()) {
                    console.log("closing");
                } else {
                    console.log("opening");
                }
            }
        });

        collapsible.addEventListener('click', () => {
            collapsible.toggle();
            console.log("clicked");
        })
    });
}
