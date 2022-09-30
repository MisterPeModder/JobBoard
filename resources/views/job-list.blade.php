@php
$currentPage = $_GET['page'] ?? '1';
@endphp

<x-layout>
    <div class="shadow-xl">
        <div class="flex flex-row flex-wrap gap-2 w-11/12 mx-auto py-2 mt-2">
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/search.svg') }}" alt="menu" class="">
                </div>
                <input type="text" aria-label="search job type"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="What position are you looking for?"></input>
            </div>
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/location.svg') }}" alt="menu" class="">
                </div>
                <input type="text" aria-label="search job location"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-highlight focus:ring-highlight sm:text-sm"
                    placeholder="Location"></input>
            </div>
            <a href="#"
                class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Find Jobs
            </a>
            <a href="#"
                class="border-2 border-highlight hover:border-highlight-light transition ease-in-out duration-150 text-highlight hover:text-highlight-light rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Filters
            </a>
        </div>
    </div>
    <main class="container mx-auto py-2 divide-y divide-l-brd/10 flex flex-col gap-2">
        <section id="adverts" class="flex flex-row flex-wrap gap-2 px-2">
            <x-job-advert id=0 title="Web 2.0 Developper" company="Web Systems Inc." location="Uranus (??)"
                job-type="Full time" salary="Up to $84,000 a year" icon="resources/images/profiles/web-sys.svg">
                <x-slot name="shortDescription">
                    <li>Be productive</li>
                    <li>Full stack position</li>
                </x-slot>
                <x-slot name="fullDescription">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam iaculis massa faucibus nisl fermentum
                    euismod. Duis efficitur viverra libero eget aliquam. Aliquam et porta elit. Quisque at consectetur
                    augue. Sed id magna eu libero semper consequat. Vestibulum efficitur turpis turpis, ut rhoncus odio
                    tempus eu. Quisque porta consectetur diam. Vivamus tincidunt mi sed volutpat blandit. Ut non lorem
                    id
                    nibh fermentum bibendum ut ut quam. Donec sed maximus ex.
                </x-slot>
            </x-job-advert>
            <x-job-advert id=1 title="Web 3.0 Developper" company="Licorn Ltd." location="Nantes (44)"
                job-type="Part-time" salary="€8,096 a month">
                <x-slot name="shortDescription">
                    <li>Be productive</li>
                    <li>Full stack position</li>
                </x-slot>
                <x-slot name="fullDescription">
                    Duis massa velit, rutrum mollis consectetur vitae, condimentum eget nunc. Proin ut risus erat. In
                    consequat justo et erat fermentum rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus consectetur dolor sit amet nibh pellentesque, sit amet tempor leo placerat. Nam malesuada
                    ligula ut quam scelerisque, rhoncus laoreet mi fringilla. Vivamus dictum lorem at ullamcorper
                    iaculis.
                    In vitae tempor lorem.
                </x-slot>
            </x-job-advert>
            <x-job-advert id=2 title="Technical Director" company="ACME" location="Paris (75)" job-type="Full-time"
                salary="€23.26 an hour" icon="resources/images/profiles/acme.svg">
                <x-slot name="shortDescription">
                    <li>Be productive</li>
                    <li>Full stack position</li>
                </x-slot>
                <x-slot name="fullDescription">
                    Donec placerat ante venenatis, cursus odio nec, euismod nibh. Mauris pulvinar aliquam lobortis.
                    Etiam fringilla enim a quam viverra, eu interdum diam varius. Sed at feugiat justo. Curabitur
                    lacinia,
                    justo
                    quis elementum dictum, erat quam dapibus metus, id tempus nibh metus sed diam. Nam nec tincidunt
                    mauris,
                    nec hendrerit est. Nulla justo turpis, cursus ac est non, laoreet maximus dui. Cras tincidunt nibh
                    vel
                    dolor blandit, in fermentum orci accumsan. Sed nisi sem, dapibus non sapien sit amet, interdum
                    sollicitudin mi. Sed vitae lorem non nulla hendrerit venenatis nec at felis.
                </x-slot>
            </x-job-advert>
            <x-job-advert id=3 title="Foreign Language Teacher" company="Hessel and Sons" location="Houston (Texas)"
                job-type="Full-time" salary="$18.50 - $23.00 an hour">
                <x-slot name="shortDescription">
                    <li>Be productive</li>
                    <li>Full stack position</li>
                </x-slot>
                <x-slot name="fullDescription">
                    Vestibulum sollicitudin tellus nec felis viverra congue. Curabitur iaculis justo metus. Vivamus
                    molestie a eros non ultricies. Sed feugiat, ipsum vel posuere bibendum, ligula elit rhoncus velit,
                    nec venenatis nulla diam id massa. Nunc molestie fringilla molestie. Pellentesque sodales arcu in
                    ante semper, non mattis tortor cursus. Vestibulum ante ipsum primis in faucibus orci luctus et
                    ultrices posuere cubilia curae; Cras sollicitudin pharetra risus, quis fermentum enim blandit id.
                    Nunc blandit mollis arcu, vitae aliquet nulla vestibulum in.
                </x-slot>
            </x-job-advert>
        </section>
        <x-page-navigation max=8 :current=$currentPage width=5 />
    </main>

    {{-- Advert options menu, requires JS --}}
    <div id="advert-options-dropdown"
        class="hidden absolute z-10 mt-2 right-2 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-l-brd/10 ring-opacity-5 focus:outline-none animate-dropdown-open animate-dropdown-close"
        role="menu" aria-orientation="vertical" tabindex="-1">
        <div class="py-1" role="none">
            <span class="flex flex-row  hover:bg-slate-100 p-2 items-end gap-2">
                <svg width="22" height="22" viewBox="0 0 22 22" version="1.1" id="svg5"
                    xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" class="fill-gray-500">
                    <defs id="defs2" />
                    <g id="layer1" transform="translate(0,-3.5229273)">
                        <g id="path27069" transform="matrix(1.0000025,0,0,0.99905046,-3.7987769e-5,0.00288531)"
                            style="fill-opacity:1;fill-rule:nonzero">
                            <path
                                style="color:#000000;stroke-linecap:square;stroke-linejoin:bevel;-inkscape-stroke:none;paint-order:markers fill stroke;fill-opacity:1;fill-rule:nonzero"
                                d="m 11.070313,3.5234375 c -0.555314,-0.00476 -1.1343206,0.3308803 -1.3964849,0.875 L 7.3242187,9.2753906 c -0.1746509,0.3624896 -0.492633,0.5903466 -0.84375,0.640625 L 1.3066406,10.658203 c -1.23272464,0.176524 -1.73318834,1.763625 -0.8847656,2.642578 l 3.7109375,3.84375 c 0.2669402,0.276545 0.3961084,0.693272 0.3261719,1.09961 l -0.9238281,5.375 c -0.1018327,0.591628 0.1511314,1.179166 0.5839843,1.513671 0.4328529,0.334506 1.1085167,0.429732 1.6523438,0.136719 l 4.6425786,-2.501953 c 0.322905,-0.173981 0.685183,-0.17002 1.005859,0.0098 l 4.603515,2.580078 c 0.538536,0.301932 1.215671,0.218112 1.654297,-0.109375 0.438626,-0.327488 0.701888,-0.910865 0.609375,-1.503906 L 17.447266,18.35355 c -0.0636,-0.407697 0.07302,-0.820363 0.34375,-1.091797 l 3.769531,-3.779297 C 22.423801,12.61697 21.948045,11.021768 20.71875,10.824253 L 15.556641,9.9941406 C 15.20614,9.9378231 14.891832,9.7038075 14.722656,9.3378906 L 12.449219,4.421875 C 12.195876,3.8739045 11.625626,3.528193 11.070313,3.5234375 Z m -0.02344,2.59375 1.875,4.0546875 c 0.434718,0.940271 1.29932,1.6172 2.320313,1.78125 l 4.343749,0.699219 -3.201171,3.208984 c -0.730801,0.732694 -1.058203,1.774655 -0.898438,2.798828 l 0.703125,4.515625 -3.798828,-2.128906 C 11.488427,20.541062 10.383196,20.530889 9.4726563,21.021484 L 5.6386719,23.087891 6.4140625,18.580078 C 6.5898798,17.558564 6.2792798,16.512171 5.5605469,15.767578 L 2.4101563,12.503906 6.7617187,11.880859 c 1.023642,-0.146581 1.8999928,-0.810957 2.3496094,-1.74414 z"
                                id="path27818" />
                        </g>
                        <path
                            style="fill:none;fill-opacity:1;stroke-width:3.27307;stroke-linecap:square;stroke-linejoin:bevel;stroke-dasharray:none;paint-order:markers fill stroke"
                            id="path1115"
                            d="m 8.4194416,10.907733 c -0.042416,0.117999 -4.0512409,0.384003 -4.1549144,0.454535 -0.1036734,0.07053 -1.8231305,3.701634 -1.9484617,3.697758 -0.1253311,-0.0039 -1.61711084,-3.734296 -1.71622747,-3.8111 -0.0991166,-0.0768 -4.08384143,-0.590032 -4.11888433,-0.710427 -0.035043,-0.120395 3.05181141,-2.6919244 3.0942274,-2.8099236 0.042416,-0.1179992 -0.7008222,-4.066294 -0.5971488,-4.1368259 0.10367344,-0.070532 3.503234,2.0705947 3.6285652,2.0744709 0.1253312,0.00388 3.6507095,-1.9230755 3.7498261,-1.8462717 0.099117,0.076804 -0.8866937,3.9716225 -0.8516508,4.0920173 0.035043,0.1203949 2.9570848,2.877768 2.9146688,2.995767 z"
                            transform="translate(0,3.5229273)" />
                        <path
                            style="fill-opacity:1;stroke-width:3.27307;stroke-linecap:square;stroke-linejoin:bevel;stroke-dasharray:none;paint-order:markers fill stroke"
                            id="path1119"
                            d="M 0.94476207,7.7158703 C 1.0100935,7.5146003 7.7580115,6.8548017 7.9291694,6.7303717 8.1003272,6.6059416 10.809416,0.39059203 11.021024,0.39053009 c 0.211608,-6.195e-5 2.924335,6.21370041 3.095566,6.33803021 0.17123,0.1243298 6.919534,0.7801781 6.984983,0.9814099 0.06545,0.2012318 -5.005911,4.7013468 -5.071243,4.9026168 -0.06533,0.20127 1.396261,6.821956 1.225103,6.946386 -0.171158,0.12443 -6.018158,-3.308108 -6.229766,-3.308046 -0.211608,6.2e-5 -6.0565979,3.436022 -6.2278286,3.311693 C 4.6266077,19.43829 6.0843233,12.81675 6.018874,12.615518 5.9534247,12.414286 0.87943059,7.9171404 0.94476207,7.7158703 Z"
                            transform="translate(-0.0231688,4.5447051)" />
                    </g>
                </svg>
                <a href="#" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Add to
                    favorites</a>
            </span>
            <a href="#" class="block px-4 py-2 text-sm text-left hover:bg-slate-100" role="menuitem"
                tabindex="-1" id="menu-item-1">Hide</a>
            <a href="#" class="block px-4 py-2 text-sm text-left hover:bg-slate-100" role="menuitem"
                tabindex="-1" id="menu-item-2">Report</a>
        </div>
    </div>
</x-layout>
