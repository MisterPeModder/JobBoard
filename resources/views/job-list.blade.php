@php
use Illuminate\Support\Facades\URL;

$currentPage = $_GET['page'] ?? '1';
$maxPage = 8;

// redirect user to first page if requested page is not valid
if ($currentPage < 1 || $currentPage > $maxPage) {
    header('Location: ' . URL::current(), true, 301);
    exit();
}
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
        <x-page-navigation :max=$maxPage :current=$currentPage width=5 />
    </main>

    {{-- Advert options menu, requires JS --}}
    <div id="advert-options-dropdown"
        class="hidden absolute z-10 mt-2 right-2 origin-top-right rounded-md bg-l-bgr-main shadow-lg ring-1 ring-l-brd/10 ring-opacity-5 focus:outline-none animate-dropdown-open animate-dropdown-close"
        role="menu" aria-orientation="vertical" tabindex="-1">
        <div class="py-1" role="none">
            <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
                @svg('resources/images/star.svg', 'fill-gray-500')
                <a href="?favorite" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Add to
                    favorites</a>
            </span>
            <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
                @svg('resources/images/delete.svg', 'fill-gray-500')
                <a href="?not-interested" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Not
                    interested</a>
            </span>
            <span class="flex flex-row hover:bg-l-bgr-content p-2 items-end gap-2">
                @svg('resources/images/flag.svg', 'fill-gray-500')
                <a href="?report" class="block text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Report</a>
            </span>
        </div>
    </div>
</x-layout>
