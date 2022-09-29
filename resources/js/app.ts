// @ts-ignore
import.meta.glob([
    '../images/**',
]);

import * as collapsible from './collapsible';

document.addEventListener("DOMContentLoaded", () => {
    collapsible.init();
    console.log("JobBoard: loaded");
});
