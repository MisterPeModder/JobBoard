<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The next-gen job search platform">

    <title>JobBoard</title>

    @vite(['resources/js/app.ts', 'resources/css/app.css'])
</head>

<body class="antialiased bg-l-bgr-main">
    <header class="flex flex-col backdrop-blur-md sticky top-0 border-b border-l-brd/10 z-20">
        <span class="flex flex-row  justify-between items-center p-2">
            <span class="flex flex-row items-center gap-2">
                <span class="logo-dot"></span>
                <a id="logo" href="/" class="text-2xl font-bold">JobBoard</a>
            </span>
            <span class="flex flex-row gap-2">
                @guest
                    {{-- "Sign In" widget, will only display when not logged --}}
                    <a href="#"
                        class="bg-l-bgr-highlight text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                        Sign in</a>
                @endguest
                <img src="{{ Vite::asset('resources/images/hamburger.svg') }}" alt="menu">
            </span>
        </span>
    </header>
    <div class="shadow-xl">
        <div class="flex flex-row flex-wrap gap-2 w-11/12 mx-auto py-2 mt-2">
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/search.svg') }}" alt="menu" class="">
                </div>
                <input type="text"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-l-bgr-highlight focus:ring-l-bgr-highlight sm:text-sm"
                    placeholder="What position are you looking for?"></input>
            </div>
            <div class="relative rounded-full shadow-sm w-full border border-inherit">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                    <img src="{{ Vite::asset('resources/images/location.svg') }}" alt="menu" class="">
                </div>
                <input type="text"
                    class="bg-inherit block py-2 w-full rounded-full pl-10 pr-4 border-0 focus:outline-2 focus:outline-l-bgr-highlight focus:ring-l-bgr-highlight sm:text-sm"
                    placeholder="Location"></input>
            </div>
            <a href="#"
                class="bg-l-bgr-highlight text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Find Jobs
            </a>
            <a href="#"
                class="border-2 border-l-bgr-highlight text-l-bgr-highlight rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
                Filters
            </a>
        </div>
    </div>
    <main class="container mx-auto py-2">
        <section id="adverts" class="flex flex-row flex-wrap gap-2 px-2">
            <x-job-advert title="Web 2.0 Developper" company="Web Systems Inc." location="Uranus (??)"
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
            <x-job-advert title="Web 3.0 Developper" company="Licorn Ltd." location="Nantes (44)" job-type="Part-time"
                salary="€8,096 a month">
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
            <x-job-advert title="Technical Director" company="ACME" location="Paris (75)" job-type="Full-time"
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
            <x-job-advert title="Foreign Language Teacher" company="Hessel and Sons" location="Houston (Texas)"
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
    </main>
</body>

</html>
