<x-layout title="Add gemstone">
    <div class= "sm:block lg:w-[1024px] lg:mx-auto text-gray-700 mt-2 mb-4 p-12">
        <h1 class="text-2xl font-bold mb-4 ">Add Gemstone</h1>
    

        <form action="/gemstones" method="POST">
            @csrf<!--This is Laravel cross-site request forgery to protect the application from malicious exploit.-->
            <div>
                <label for="name" class="font-medium">Name:</label>
                <input class=" block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="name" name="name" value="{{ old('name')}}"/>
                @error ('name') <!-- Checking validation error for the name form  field -->
                <!-- It is to dysplay validation error message for the "name" field.-->
                <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div> <!--The variable $message is from Laravel's validation system containing the error text.-->
                @enderror
            </div>

            <div>
                <label for="location" class="font-medium">Location:</label>
                <input class="block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="location" name="location" value="{{ old('location')}}"/>
            </div>
            @error ('location') <!-- Checking validation error for location field -->
                <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
            @enderror

            <div>
                <label for="colour" class="font-medium" >Colour:</label>
                <input class="block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="colour" name="colour" value="{{ old('colour')}}"/>
            </div>
            @error ('colour') <!-- Checking validation error for colour field -->
                <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
            @enderror

            <div>
                <label for="association" class="font-medium">Association:</label> 
                <input class="block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="association" name="association" value="{{ old('association')}}"/>
            </div>
            @error ('association') <!-- Checking validation error for association field -->
                <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
            @enderror

            <div>
                <label for="meaning" class="font-medium">Meaning:</label>
                <input class="block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="meaning" name="meaning" value="{{ old('meaning')}}"/>
            </div>
            @error ('meaning') <!-- Checking validation error for meaning field -->
                <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
            @enderror

            <div>
                <label for="grade" class="font-medium">Please select the grades for your gemstone:</label>
                <div class= "grid grid-cols-1 gap-2 mt- 2">
                    @foreach ($grades as $grade)
                        <label class="flex items-center space-x-2">
                        <input class="rounded" type="checkbox" name="grade_id[]" value="{{ $grade->id }}"><span>{{ $grade->name }}</span>
                        </label>
                    @endforeach

                    @error ('grade_id')
                        <div class="text-red-600 text-sm  bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
                    @enderror
                    
                </div>
            </div>

            <div>
                <button class="sm:flex px-6 py-2 mt-4 bg-[#a1b5ae] border rounded" type="submit">Save</button>
            </div>

        </form>
    </div>
</x-layout>
