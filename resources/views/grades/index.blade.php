
<x-layout title="Gemstone Grades">
    <div>
        <h1 class="text-2xl font-bold mb-6 ">Gemstone Grades</h1>

        @foreach ($grades as $grade)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">{{$grade->name}}</h2>
                <p class="pb-3 italic">{{$grade->description}}</p>

                @if ($grade->gemstones->isEmpty())
                    <p class ="text-gray-450 italic">No gemstone classified under this grade.</p>
                @else
                    <ul class="text-gray-500 list-disc ml-6 mt-2">
                        @foreach ($grade->gemstones  as $gemstone)
                            <li> {{$gemstone->name}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</x-layout>