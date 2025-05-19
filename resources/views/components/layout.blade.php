<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class= "bg-[#FCFAEE]" >
  <x-nav-bar/> <!-- The navigation bar will apear here -->
  <main class="sm:block lg:w-[1024px] text-gray-700 mt-2 mb-4 p-12">
  {{ $slot }}
  </main>
  
</body>
</html>