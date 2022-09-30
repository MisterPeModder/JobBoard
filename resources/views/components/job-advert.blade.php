{{-- A job advert component with a collapsible description --}}

<div
    class="relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-l-bgr-highlight flex flex-col">

    <span class="flex flex-row gap-2 items-start justify-between">
        <div class="flex flex-row gap-2">
            @isset($icon)
                <img src="{{ Vite::asset($icon) }}" alt="icon"
                    class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
            @endisset
            <div>
                <h2 class="font-semibold">{{ $title }}</h2>
                <div class="hover:no-underline">{{ $company }}</div>
                <div class="">{{ $location }}</div>
            </div>
        </div>
        <button type="button" aria-label="advert options">
            <img src="{{ Vite::asset('resources/images/three-dots.svg') }}" alt="advert options">
        </button>
    </span>
    <ol class="list-disc list-inside border-y border-solid border-l-brd/10 my-2 py-2">
        {{ $shortDescription }}
    </ol>
    <details class="text-sm">
        <summary data-open="Learn more" data-close="Collapse"
            class="text-base text-l-bgr-highlight hover:underline cursor-pointer">
        </summary>
        <div class="flex flex-col divide-y divide-solid divide-l-brd/10 gap-1">
            <div>
                <h2 class="text-base font-semibold py-2">Job Details</h2>
                <div>
                    <h3 class="font-semibold inline">Salary:</h3>
                    <p class="inline">{{ $salary }}</p>
                </div>
                <div>
                    <h3 class="font-semibold inline">Type:</h3>
                    <p class="inline">{{ $jobType }}</p>
                </div>
            </div>
            <div class="pt-1">
                <h2 class="text-base font-semibold py-2">Full Description</h2>
                <p>{{ $fullDescription }}</p>
            </div>
        </div>
        <span class="mt-2 flex flex-row gap-2 items-center">
            <button type="button" aria-label="apply now"
                class="bg-l-bgr-highlight text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold">Apply
                now</button>
            <button type="button" aria-label="save to favorites"
                class="bg-slate-400 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold">
                {{-- Contents of resources/images/star.svg --}}
                <svg class="fill-white hover:fill-yellow-200" width="22" height="22" viewBox="0 0 22 22"
                    version="1.1" id="svg5" xmlns="http://www.w3.org/2000/svg"
                    xmlns:svg="http://www.w3.org/2000/svg">
                    <defs id="defs2" />
                    <g id="layer1" transform="translate(0,-3.5229273)">
                        <g id="path27069" transform="matrix(1.0000025,0,0,0.99905046,-3.7987769e-5,0.00288531)"
                            style="fill-opacity:1;fill-rule:nonzero">
                            <path
                                style="color:#000000;stroke-linecap:square;stroke-linejoin:bevel;-inkscape-stroke:none;paint-order:markers fill stroke;fill-opacity:1;fill-rule:nonzero"
                                d="m 11.070313,3.5234375 c -0.555314,-0.00476 -1.1343206,0.3308803 -1.3964849,0.875 L 7.3242187,9.2753906 c -0.1746509,0.3624896 -0.492633,0.5903466 -0.84375,0.640625 L 1.3066406,10.658203 c -1.23272464,0.176524 -1.73318834,1.763625 -0.8847656,2.642578 l 3.7109375,3.84375 c 0.2669402,0.276545 0.3961084,0.693272 0.3261719,1.09961 l -0.9238281,5.375 c -0.1018327,0.591628 0.1511314,1.179166 0.5839843,1.513671 0.4328529,0.334506 1.1085167,0.429732 1.6523438,0.136719 l 4.6425786,-2.501953 c 0.322905,-0.173981 0.685183,-0.17002 1.005859,0.0098 l 4.603515,2.580078 c 0.538536,0.301932 1.215671,0.218112 1.654297,-0.109375 0.438626,-0.327488 0.701888,-0.910865 0.609375,-1.503906 L 17.447266,18.35355 c -0.0636,-0.407697 0.07302,-0.820363 0.34375,-1.091797 l 3.769531,-3.779297 C 22.423801,12.61697 21.948045,11.021768 20.71875,10.824253 L 15.556641,9.9941406 C 15.20614,9.9378231 14.891832,9.7038075 14.722656,9.3378906 L 12.449219,4.421875 C 12.195876,3.8739045 11.625626,3.528193 11.070313,3.5234375 Z m -0.02344,2.59375 1.875,4.0546875 c 0.434718,0.940271 1.29932,1.6172 2.320313,1.78125 l 4.343749,0.699219 -3.201171,3.208984 c -0.730801,0.732694 -1.058203,1.774655 -0.898438,2.798828 l 0.703125,4.515625 -3.798828,-2.128906 C 11.488427,20.541062 10.383196,20.530889 9.4726563,21.021484 L 5.6386719,23.087891 6.4140625,18.580078 C 6.5898798,17.558564 6.2792798,16.512171 5.5605469,15.767578 L 2.4101563,12.503906 6.7617187,11.880859 c 1.023642,-0.146581 1.8999928,-0.810957 2.3496094,-1.74414 z"
                                id="path27818" />
                        </g>
                    </g>
                </svg>
            </button>
        </span>
    </details>
</div>
