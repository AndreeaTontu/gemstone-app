
<header class="bg-[#C8AD7F] text-white" >  
  <!--desktop-header-wrapper-->
  <div class="sm:flex sm:justify-between lg:w-[1024px]">
    <!--header-wrapper-->
    <div class="flex justify-between p-0">
      <!--logo-->
      
        <a class="font-bold text-lg font-sans pl-10 " href="/gemstones">Meaningful Gemstones App </a> 
      <!-- open icon-->
      <div 
        id="openIcon"
        class="cursor-pointer block sm:hidden " 
      >
        <svg width="30px" viewBox="0 0 10 10" fill="none">
          <path d="M1 1h8M1 4h8M1 7h8" stroke="#fff" stroke-width="1" />
        </svg>
      </div>
      <!-- close icon-->
      <div
        id="closeIcon"
        class=" menu-icon cursor-pointer hidden sm:hidden menu-icon"
      >
      
        <svg xmlns="http://www.w3.org/2000/svg"  width="40" height="40" viewbox="0 0 40 40">
            <line x1="1" y1="11" 
                x2="11" y2="1" 
                stroke="white" 
                stroke-width="2"/>
            <line x1="1" y1="1" 
                x2="11" y2="11" 
                stroke="white" 
                stroke-width="2"/>
        </svg>
      </div>
      </div>
    </div>

    <nav class="lg:px-8 ">
      <ul id="navList" class=" hidden sm:flex sm:justify-end sm:p-3 text-lg font-sans">
        <li class=" sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/gemstones">Home</a></li>
        @can('edit')
        <li class=" sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/gemstones/create">Add Gemstone</a></li>
        @endcan
        <li class="sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/grades">Grades</a></li>
        @auth
        <li class= "sm:inline sm:border-0 border-t border-white">
          <span class="text-gray-200 pr-3">
            Logged in as <span class="font-semibold text-slate-500"> {{Auth::user()->name}}</span>
            <form method='POST' action='/logout' class="sm:inline-block sm:border-0 border-t border-white">
              @csrf
              <button class="sm:inline-block pt-1 pr-3 pb-1 pl-3 border rounded hover:bg-[#a16207]/50" type="submit">Logout</button>
            </form>
          </span>
        </li> 
        @endauth
        @guest
        <li class="sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/login">Log In</a></li>
        @endguest

        @guest
        <li class="sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/register">Sign Up</a></li>
        @endguest

        <li class="sm:inline sm:border-0 border-t border-white">
          <a class="sm:inline-block pt-1 pr-3 pb-1 pl-3 hover:bg-[#a16207]/50" href="/gemstones/about">About</a> </li>
      </ul>
    </nav> 
  </div>
</header> 



