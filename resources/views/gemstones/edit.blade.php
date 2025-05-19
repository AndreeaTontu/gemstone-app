<x-layout title="Modify gemstone">
    <h1 class="text-2xl font-bold mb-4 ">Modify the details for {{$gemstone->name}}</h1>
    <form action="/gemstones/{{$gemstone->id}}" method="POST">

    @csrf
    @method('PATCH')
    <!--A hidden field contains the id number of the film -->
    <input type="hidden" name="id" value="{{$gemstone->id}}">
    <div>
        <label for="name">Name:</label>
        <!-- The text boxes are populated with values from the database ready for the user to edit -->
        <input class="block py-1 border border-gray-300 rounded" type="text" id="name" name="name" value="{{$gemstone->name}}">
    </div>
    <div class="mt-3">
        <label for="location">Location:</label>
        <input class="block py-1 border border-gray-300 rounded" type="text" id="location" name="location" value="{{$gemstone->location}}">
    </div>
    <div class="mt-3">
        <label for="colour">Colour:</label>
        <input class=" block py-1 border border-gray-300 rounded" type="text" id="colour" name="colour" value="{{$gemstone->colour}}">
    </div>
    <div class="mt-3">
        <label for="association">Association:</label>
        <input class=" block py-1 border border-gray-300 rounded" type="text" id="association" name="association" value="{{$gemstone->association}}">
    </div>
    <div class="mt-3">
        <label for="meaning">Meaning:</label>
        <input class="block py-1 border border-gray-300 rounded" type="text" id="meaning" name="meaning" value="{{$gemstone->meaning}}">
    </div>
    <div class="mt-3">
        <label for="grade_id">Meaning:</label>
        <input class="block py-1 border border-gray-300 rounded" type="text" id="meaning" name="meaning" value="{{$gemstone->meaning}}">
    </div>

    <div>
        <label for="grades">Select Grades:</label>
        <div>
            @foreach ($grades as $grade)
                <label class="inline-flex itemes-center">
                    <input 
                        type="checkbox" 
                        name="grade_id[]" 
                        value="{{$grade->id}}" 
                        {{$gemstone->grades->contains($grade->id) ? 'checked' : ''}} class="form-checkbox h-5 w-5 text-blue-500"/>
                        <span class="ml-1">{{$grade->name}}</span>
                </label>
            @endforeach
        </div>
    </div>


    <div>
        <button class="sm:flex px-6 py-2 mt-4 bg-[#a1b5ae] border rounded" type="submit">Save</button>
    </div>

    
    </form>
</x-layout>