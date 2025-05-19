<x-layout title="Show the details">
    <div >
        <h1 class="flex text-2xl font-bold mb-4 ">
            {{$gemstone->name}}
        </h1>
            <p>Location: {{$gemstone->location}}</p>
            <p>Colour: {{$gemstone->colour}}</p>
            <p>Association: {{$gemstone->association}}</p>
            <p>Meaning: {{$gemstone->meaning}}</p>
    

    @can('edit')
    <a href='/gemstones/{{$gemstone->id}}/edit'>
        <button class="sm:flex px-6 py-2 mt-4 bg-[#a1b5ae] border rounded">Modify</button>
    </a>

    <form method='POST' action='/gemstones/{{$gemstone->id}}'>
        @csrf
        @method('DELETE') <!-- A Laravel method used to interpret the form as Delete request  -->
        <input type="hidden" name="id" value="{{$gemstone->id}}">
        <button class="sm:flex px-6 py-2 mt-4 bg-[#a1b5ae] border rounded" type='submit'>Delete</button>
    @endcan
    </div>
</x-layout>