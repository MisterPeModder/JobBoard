// @ts-ignore
import.meta.glob([
    '../images/**',
]);

import * as jobAdverts from './jobAdverts';

document.addEventListener("DOMContentLoaded", () => {
    console.log("JobBoard: loaded");
    jobAdverts.init();
});
