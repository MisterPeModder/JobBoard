/**
 * Powers the image-preview capabilities of the <x-image-input> component.
 * 
 * @module imageInput
 */

/**
 * Attach events to the given image input component.
 */
export function attach(imageInput: HTMLElement) {
    const field = imageInput.querySelector('input');

    if (field === null) {
        console.error('<x-image-input> component is missing its image field', imageInput);
        return;
    }

    field.onchange = () => {
        const [image] = field.files;

        if (image == null || !/^\s*image\//.test(image.type)) {
            // image was cleared, or file is not an image 
            const url = imageInput.style.backgroundImage.replace(/^url\((.*)\)$/, '$1'); // get the previous image URL...
            URL.revokeObjectURL(url);                                                    // .. and destroy it.
            imageInput.style.backgroundImage = '';
            imageInput.style.removeProperty('backgroundImage'); // clear the background image
            imageInput.querySelector('.image-input-hint').classList.remove('hidden');  // show the 'click or drop image' hint
        } else {
            // image was added
            imageInput.style.backgroundImage = `url(${URL.createObjectURL(image)})`; // set background to new image
            imageInput.querySelector('.image-input-hint').classList.add('hidden'); // hide the 'click or drop image' hint
        }
    };

    // Drag-and-drop support
    field.ondragover = event => event.preventDefault();
}

export function init() {
    // attach events to all <x-image-input> components currently on the page
    document.querySelectorAll('.image-input').forEach(imageInput => attach(imageInput as HTMLElement));
}
