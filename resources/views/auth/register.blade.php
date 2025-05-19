<x-layout title="Sign Up">
    <div class= "sm:block lg:w-[1024px] lg:mx-auto text-gray-700 mt-2 mb-4 pt-12">
        <h1 class="text-2xl font-bold mb-4 ">Sign Up</h1>
        <form method="POST" action="/register">
            @csrf
            <div>
                <label for="name" class="font-medium block mb-1">Full Name:</label>
                <input class=" block py-1 border border-gray-300 rounded-lg focus-ring" type="text" id="name" name="name" placeholder="Enter your full name" value="{{ old('name')}}"/>
                @error('name')
                    <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="font-medium block mb-1">Email:</label>
                <input class=" block py-1 border border-gray-300 rounded-lg focus-ring" type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email')}}"/>
                @error('email')
                    <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="font-medium block mb-1">Password:</label>
                <input class=" block py-1 border border-gray-300 rounded-lg focus-ring" type="password" id="password" name="password" placeholder="Create password"/>

                @error('password')
                    <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="font-medium block mb-1">Confirm Password:</label>
                <input class=" block py-1 border border-gray-300 rounded-lg focus-ring" type="password" id="password_confirmation" name="password_confirmation" />
                @error('password_confirmation')
                    <div class="text-red-600 text-sm bg-red-50 border border-red-200 p-2 m-2 rounded">{{$message}}</div>
                @enderror
            </div>

            <div>
                <button class="sm:flex px-6 py-2 mt-4 bg-[#a1b5ae] border rounded" type="submit">Sign Up</button>
            </div>
        </form>
    </div>
</x-layout>