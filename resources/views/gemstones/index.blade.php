<x-layout title="Home Page">
    <!-- main-content-->
    <div>
    <div class=" border-y-gray-800">
        <header class="text- py-8 ">
            <h2 class="text-2xl font-bold mb-4">A Little Histrory of Turqoise Gemstone</h2>
            <div class= "flex justify-center items-left pt-10">
            <img class="rounded-lg shadow-lg max-w-full" src="./images/turqoise_gemstone_photo.jpg" alt="Turqoise Poster">
            </div>
        </header>
            <div class="py-6">
                <p class="pb-2">
                Turquoise has been admired for its vibrant color since ancient times. 
                In Egypt, turquoise adorned jewelry, gold inlays, and King Tut's burial mask, with mines dating back to 3000 BCE near the Sinai Peninsula. 
                It was called mefkat, meaning “joy.”
                </p>
                <p class="pb-2">
                Turquoise represented heaven and was thought to offer protection in Persia.
                Pirouzeh, which means "victory," was used for decorating jewellery, weapons, and palace domes.
                Known as turquoise, or "Turkish stone," it was brought to Europe by Turkish traders in the 13th century.
                </p>
                <p class="pb-2">
                In the Americas, turquoise was mined and used in spiritual ceremonies by Native American tribes in the southwestern United States before the arrival of European settlers.
                The Aztecs used turquoise on ceremonial masks and implements for its protective properties, while the Apache thought it could increase a hunter's precision.
                Navajo artisans started producing the turquoise-studded silver jewellery that has come to represent Native American culture by the 1880s. 
                </p>
                <p class="pb-2">
                Today, turquoise remains a global symbol of joy, protection, and cultural heritage.
                </p>
            </div>
    </div>

    <div class="p-10">
    @auth 
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($gemstones as $gemstone)
        <div class="bg-stone-50 rounded-lg shadow-md p-8 border border-gray-200">
            <a class="block" href="/gemstones/{{$gemstone->id}}">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">{{$gemstone->name}}</h2>
                <p class="text-sm text-gray-600">
                    Grades: <span class="font-medium text-gray-600">{{$gemstone->grades->pluck('name')->join(', ')}}</span>
                </p>
            </a>
        </div>
        @endforeach 
    </div>
    @endauth 

    @guest 
    <div class="sm:block text-center bg-amber-100 border-amber-200 text-amber-600 p-4 rounded">
        <p class="text-lg font-semibold"> Please Log In</p>
        <p class="text-sm">If you want to see our amazing gemstone list, you must login. If you don't have an account, please <a class="underline text-blue-500 hover:text-blue-700" href="/register"> Sign Up</a>.</p>
    </div>
    @endguest 
</div>
</x-layout>

