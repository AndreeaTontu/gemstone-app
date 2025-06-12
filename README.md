## What is the Gemstone App

The Gemstone App is a web-based app that aims to be a user-friendly platform for enthusiast users to discover and manage gemstones, also known as meaningful stones. Users can explore various gemstone collections, study details about each one, such as name, colour, location, meaning and association, and add new gemstones to the database. Additionally, users may add their favourite gemstones to the database, guaranteeing a personal and large gemstone collection.
The app will include basic CRUD functionality, allowing users to Create, Read, Update and Delete gemstone data. 

## UI Preview

## Guest Users Home Page 

![screencapture-gemstone-app-test-gemstones-2025-06-11-21_38_20](https://github.com/user-attachments/assets/459979b6-1436-47a7-9a03-cf919bf4353c) 

## Logged in User Home Page

![screencapture-gemstone-app-test-gemstones-2025-06-11-21_37_50](https://github.com/user-attachments/assets/a4939049-c938-450c-99cd-e62a7a578231)

## Gemstone Info Page + Update

![screencapture-gemstone-app-test-gemstones-2-2025-06-11-21_40_09](https://github.com/user-attachments/assets/fd63b4ac-ced8-4c37-a703-6f06c4ebba33)

## Gemstone Grades Page

![screencapture-gemstone-app-test-grades-2025-06-11-21_38_58](https://github.com/user-attachments/assets/29b46f11-b56d-4549-a738-d053ebaa579a)

## Add New Records Page

![screencapture-gemstone-app-test-gemstones-create-2025-06-12-16_49_56](https://github.com/user-attachments/assets/7fd54f8a-a9d8-4af7-9890-d954cb01f750)

## Demonstration

## Components

Components are simply reusable code fragments that can help in the maintenance of a cleaner codebase. 

## Navigation Bar Component

Below is the nav-bar.blade.php component:

    <nav>
      <ul>
        <li><a href="/gemstones">Home</a></li>
        <li><a href="/gemstones/create">Add Gemstone</a></li>
        <li style="float:right"> <a href="/gemstones/about">About</a> </li>
      </ul>
    </nav> 

The file was created in the components directory, and we called it nav-bar.blade.php. To make it visible on the browser, we must call it in the base layout layout.blade.php. 

    <body>
        <x-nav-bar/> <!-- The navigation bar will apear here -->
        {{ $slot }}
    </body>

*When creating component, we make the code more organised, making it easier to add, update or remove code without affecting the rest of the application. It also reduces code duplication by following DRY principle.*

## Validation for Data Storing

It is a good practice to add validation when the user tries to input some data. 
To do this we need to import the *Validator Facade* in the *GemstoneController*:

    use Illuminate\Support\Facades\Validator

This will provide methods to validate data against predeterminate rules.

    function store(Request $request) 
        {   
            $rules=[
                'name' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'location' => 'required|string|max:100|regex:/^([a-zA-Z,]+)(\s[a-zA-Z,]+)*$/',
                'colour'  => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'association' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
                'meaning' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',

            ];
        }

-	*$rules* variable has an array containing validations rules for each field. 
-	The *required* is used to ensure that the field is not empty. 
-	To state that the value must be a string we use the string rule. 
-	*max:100* this limits the length of the input field. 
-	*regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/* this imposes specific character and spaces rules. 

Next, we add message errors. To define customised error messages, we create an array for *$messages*.
This approach is useful for reusing validation rules in different parts of the application.

    $messages = [
                'name.required' => 'The name is required.',
                'location.required' => 'Please enter a location.',
                'colour.required' => 'A colour is required.',
                'association.required' => 'Please enter an association.',
                'meaning.required' => 'A meaning is required.',
            ];

For example, the *location.required* key donate the field location and the corresponding rule required to which the custom message must be applied. 

## Validation Error Handlining 

For error handling, we need to update the *create.blade.php*.
    
    <div>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="{{ old('location')}}"/>
    </div>
    @error ('location') <!-- Checking validation error for location field -->
        <div class="error-message">{{$message}}</div>
    @enderror

-	*value="{{ old('location')}}*  it is a global old helper provided by Laravel to repopulate the form. It retains the previous input if the validation fails. 
-	To check if there is a validation error associated with the filed location, we use the directive *@error*.
-	If validation fails, *{{message}}* will output the associated error message for this field.

## Elequent Relantionships 

*Many-to-many* relationship was accomplished using *belongsToMany()* method which is implemeted in Elequent.
For a many-to-many relationship we must have at least three tables. Firstly, we create a table called *grades* that stores grades information. Then a tirth table is created (also called *Pivot Table*). This will store the relationship between gemstones.
 

## Database Tables Set Up

Adding grades database table using Artisan:

    php artisan make:migration create_grades_table --create=grades

Next, we modify the migration file like this:

        public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
    }

- This function will create the grades table.

## Elequent Relationship Set Up
Next, we define the relationship in the Elequent models.
We create the *Grade* model using the following command:

    php artisan make:model Grade

First, we need to add the *belongsToMany* class to the Gemstone and Grade models to reprsent the *Many-to-many* relationship between the two Elequent models:

    use Illuminate\Database\Eloquent\Relations\BelongsToMany;

The Grade model:

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }

- *grade()* method returns a *BelongToMany* relationship. 
- To specifie that the Gemstone model has a many-to-many relationship with Grade model we use *belongsToMany(Grade::class)* method.

The Gemstone model looks something like this: 

    public function gemstones(): BelongsToMany
    {
        return $this->belongsToMany(Gemstone::class);
                
    }

- *gemstones(): BelongsToMany* method defines that the *Grade* model can have multiple gemstones.

- There is a many-to-many relationship between gemstones and grades table. A gemstone can have multiple grades and a grade can belong to many gemstones. 

## Seeding

We create the GradeSeeder:

    php artisan make:seeder GradeSeeder

Now we must seed the Grades table: 

    public function run(): void
    {
        DB::table('grades')->insert([
            [
                'name' => 'AAA',
                'description' => 'Highest quality with exceptional clarity, color, and cut.',
            ],
            [
                'name' => 'AA',
                'description' => 'High quality with very good clarity, color, and cut.',
            ],
            [
                'name' => 'A',
                'description' => 'Good quality with some visible inclusions or slight color variance.',
            ],
            [
                'name' => 'B',
                'description' => 'Average quality often used in commercial settings, may have noticeable inclusions.',
            ],
            [
                'name' => 'C',
                'description' => 'Below average quality with obvious inclusions and significant flaws.',
            ],
        ]);        
    }

- This will seed the grades table in the *name* and *description*b columns. 

Next, we modify the *GemstoneSeeder* so that it will handle the many-to-many relationship between *gemstones* and *grades*. We use *foreach* loop to iterate through the array of gemstones and execute operations on each gemstone.

        public function run()
    {
        $gemstones = [
            [
                'name' => 'Turqoise' ,
                'location' => 'USA, China, Egypt' , 
                'colour' => 'Blue-green vibrant' , 
                'association' =>'Throat Chakra' , 
                'meaning' => 'Balance, Protection',
                'grades'=>[1,2,3],
            ],
            [
                'name' => 'Rose Quartz' ,
                'location' => 'Brazil, Madagascar, India' , 
                'colour' => 'Pink' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Unconditional love, Heealing, Compassion',
                'grades'=>[2,3]
                ],
            [
                'name' => 'Amethyst' ,
                'location' => 'Uruguay, Brazil' , 
                'colour' => 'Purple' , 
                'association' =>'Crown Chakra' , 
                'meaning' => 'Clarity, Spiritual protection',
                'grades'=>[4,5]
            ],
            [
                'name' => 'Citrine' ,
                'location' => 'Brazil, Spain' , 
                'colour' => 'Yellow' , 
                'association' =>'Solar Plexus Chakra' , 
                'meaning' => 'Positivity,  Self-confidence',
                'grades'=>[3,4]
            ],
            [
                'name' => 'Sapphire' ,
                'location' => 'Thailand, Sri Lanka' , 
                'colour' => 'Blue' , 
                'association' =>'Third Eye Chakra' , 
                'meaning' => 'Integriy, Wisdom',
                'grades'=>[2,3]
            ],
            [
                'name' => 'Emerald' ,
                'location' => 'Brazil, Colombia' , 
                'colour' => 'Green' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Growth, Patience',
                'grades'=>[2,3,4]],
        [
                'name' => 'Garnet' ,
                'location' => 'Sri Lanka, India' , 
                'colour' => 'Red, Green' , 
                'association' =>'Root Chakra' , 
                'meaning' => 'Passion, Vitality',
                'grades'=>[4,5]],
            [
                'name' => "Tiger's Eye" ,
                'location' => 'Western Australia, South Africa' , 
                'colour' => 'Golden-brown' , 
                'association' =>'Solar Plexus Chakra' , 
                'meaning' => 'Courage, Self-discipline',
                'grades'=>[1,2]],
            [
                'name' => 'Jade' ,
                'location' => 'Guatemala, China' , 
                'colour' => 'Green' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Health, Prosperity',
                'grades'=>[3,4]],
            [
                'name' => 'Moonstone' ,
                'location' => 'Sri Lanka, India' , 
                'colour' => 'Blue Sheen, White' , 
                'association' =>'Crown Chakra' , 
                'meaning' => 'Balance, Intuition, New beginnings',
                'grades'=>[2,3,4]],
        ];
        
        // Loop through each gemstone and insert it
        foreach ($gemstones as $data) {
            // Use firstOrCreate to avoid duplicates
            $gemstone = Gemstone::firstOrCreate([
                'name' => $data['name'],
                'location' => $data['location'],
                'colour' => $data['colour'],
                'association' => $data['association'],
                'meaning' => $data['meaning'],
            ]);

            // Attach grades via pivot table
            $gemstone->grades()->attach($data['grades']);
        }
        
        }

- To show a gemstone association with multiple grades we add a new array to *$gemstone*, such as *'grades'=>[2,3]*. Each value in the array corresponds to a grade's ID from the grades table. 
- *foreach ($gemstones as $data)* here *$data* holds the present gemstone's attributes on each iteration. 
- To prevent dublicates we use the *firstOrCreate* method. This will check if if gemstone with the same *name, location, colour, association, and meaning* already exist. It will retrive the gemsstone if already exist and if it does not exist, it will insert the gemstone in the database.
- To attach the grades IDs to the *gemstone* we use *attach($data['grades'])*

We must to modify the DatabaseSeeder:

    public function run(): void
    {

        $this->call([
            GradeSeeder::class,
            GemstoneSeeder::class,
        ]);
    }

- This will run the *GradeSeeder* before *GemstoneSeeder* as this requires grades to already exist in the database in order to be properly attached.

In the new GradeController we add an *index()* method:

     function index(){
        //In a many-to-many relationship, we may want to display each grade and its associated gemstones.
        //load gemstones associated with each grade
        $grades = Grade::with('gemstones')->get();
        return view('grades.index', ['grades' => $grades]);
    }

- *$grades = Grade::with('gemstones')->get()*: this reduces database interaction by fetching all grades and their corresponded gemstones. 
- *with()* method is efficient due to its eager loading in Elequent ORM. Without eager loading, each grade requires a new database query to retrive its gemstone. This results in N+1 queries, N being the number of grades.

## Pivot Table

Creating a Pivot Table called *gemstone_grade* to demonstrate a many-to-many relationship:

     public function up(): void
    {
        Schema::create('gemstone_grade', function (Blueprint $table) {
            $table->id();
            $table->foreignID('gemstone_id')->references('id')->on('gemstones') //creating gemstone_id column and defining the foreign key
                  ->onDelete('cascade');
            $table->foreignID('grade_id')->references('id')->on('grades') //creating grade_id column and defining the foreign key
                  ->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gemstone_grade');
    }

- *$table->foreignID('gemstone_id')->references('id')->on('gemstones')* this creates *gemstone_id* column and defines the foreign key.
- *$table->foreignID('grade_id')->references('id')->on('grades')* this creates *grade_id* column and defines the foreign key.

We add a checkbox with the grades in the form to the *create.blade.php*, so that the user can sellect one or more grades:

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

We must modify the *create()* function in the GemstoneController:

    function create()
    {   
        $grades = Grade::all();
        return view('gemstones.create',  ['grades' => $grades]);
    }

- This function is responsible for loading the create form from *create.blade.php*. It fethes a collection of all grades. 

We modify the *edit()* and *update()* functions in GemstoneController: 

        function edit($id)
    {
        $gemstone = Gemstone::findOrFail($id);
        $grades = Grade::all();
        return view('gemstones.edit', ['gemstone' => $gemstone, 'grades'=>$grades]);
    }

- The *findOrFail($id)* method will try to find the gemstone with the specified id. If it is not found it will throw a 404 error. 

        function update(Request $request, $id)
    {
        $validator = $this->validateGemstone(($request));
       
        $gemstone = Gemstone::find($id);
        $gemstone->update([
            'name'=>$request->name,
            'location'=>$request->location,
            'colour'=>$request->colour,
            'association'=>$request->association,
            'meaning'=>$request->meaning,
        ]);
        //Sync grades. 
        $gemstone->grades()->sync($request->grade_id);
        return redirect('/gemstones');
    }
 - *$gemstone->grades()->sync($request->grade_id);*: this will sync selected grades during updates. 

## Authentication

## LogIn Validation

To avoid any incorrect or malicious data being submitted, it is important to add validation to the login form.

        function login(Request $request)
    {   
        // Validation 
        $request->validate([
            'email'=>'required|email', 
            'password'=>'required|min:6', 
            ]);

        $user_details = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($user_details)) {
            $request->session()->regenerate();
            return redirect('/gemstones');
        }
        // Redirect back with error message if login fails
        return back()->withErrors(['email'=>'Invalid email or password.',]);
    }

- *'email'=>'required|email'* this will ensure that the email field is required and valid.
- *'password'=>'required|min:6'* this will ensure that the password is required, and it is at least six characters long. 
- *return back()->withErrors* if the user fails to log in it will redirect back with an error message. 

## Registration

Registration was created to let new users sign up for the app.

We first need to add an *index()* method to the controller:

       public function registrationForm()
    {
        return view('auth.register');
    }

Next, we add a route for the registration form to *web.php*:

    Route::get('/register', [AuthController::class, 'registrationForm'])->name("register");

Then we add a route to handle the registration form:

    Route::post('/register', [AuthController::class, 'register']);

To make these work we must call the *AuthContoller*:

    use App\Http\Controllers\AuthController;

Next, we add *register()* method to handle the register route.  We use Elequent ORM to create a new user. Validation was implemented here as well. 

    public function register (Request $request)
    {
        // Validation 
        $request->validate([
            'name' => 'required|string|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'required|string|max:255|email|unique:users,email', //Unique email
            'password' => 'required|string|min:6|confirmed', // Must have a minimum 6 characters and passwards match
        ]);
        
        $user = User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password.

        ]);

        auth()->login($user); //This will automatically log in the user

        return redirect('/gemstones');

    }

- *User::create()* this will create a new user record in the user table. *User* class is part of Elequent model that represents the user's table.
- *'name'=>$request->name* this sets the new user's name columns in the database after retrieving the name input from the HTTP request.
- *'email' => $request->email* here it will sets the email column of the new user.
- 'password' => Hash::make($request->password) it hashes the password. It is a secure one-way hashing algorithms such as bcrypt. This means that the duration required to produce a hash can be increased as hardware capabilities advance. The password is converted into a secure format.
- When registering a new user is important to add a validation to the email to be unique *'email' => 'require|unique:users,email'*.

To make the registration form visible we create *register.blade.php* in the *views*. Something like this:

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

## Responsive Design 

Tailwind CSS and JavaScript are used to ensure uniform styling across various screen sizes. The Gemstone app is optimised for both mobile and desktop users. 

## Tailwind CSS for Layout and Styling

Tailwind enables us to build custom designs with utility classes that optimise the development process.
We used a grid layout for a more visually appealing display of our gemstone list. It was applied to the *index.blade.php*.

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

- *class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"* To create a grid container we use *grid*. *sm:grid-cols-2* it will set two columns for small screens. *md:grid-cols-3 this* will set three columns for medium screens. For large screens we use *lg:grid-cols-4* to set four columns. To add some space between the greed items we set the gap to *gap-6*.
- *class="bg-stone-50 rounded-lg shadow-md p-8 border border-gray-200"*: using this class we style the *gemstone card* . It will set a background with a light stone colour, it adds a large border-radius for rounded corners, it will create a 3D effect by applying medium shadow. To make the content spacoius we add a padding set to 8 and finaly we add a subtle gray border. 
- To add smaller, muted text for the grades section we use *class="text-sm text-gray-600"*. This will maintain a cleaner design. 


Utilising Tailwind classes enables a responsive, grid-based layout that dinamically adjust the column count according to screen size.

## Applying Tailwind in Components

Something interesting we can do with tailwind is to apply it to components. For example we can add some tailwind in the *layout.blade.php*. This approach gives consistent styilng across all pages. By applying tailwind in the component we do not need to add multiple CSS rules in the other files. 

    <body class= "bg-[#FCFAEE]" >
    <x-nav-bar/> <!-- The navigation bar will apear here -->
    <main class="sm:block lg:w-[1024px] text-gray-700 mt-2 mb-4 p-12">
    {{ $slot }}
    </main> 
    </body>

- **class= "bg-[#FCFAEE]"** this class will set the body background colour for all the pages. 
- A utility class is added to the main tag. The layout style will be applied to the main content of all pages. *sm:block* arranges the content vertically, and the *lg:w-[1024px]* limits the width for larger screens. This prevents from writing @media querie in CSS. 


## JavaScript for Interactivity

We used JavaScript for the hamburger menu to toggle the menu on mobile devices. When clicked it will show or hide the navigation links. We applied the event listener to icons representing the state of the *open and close* menu. On the *app.js* file we add the following code: 

    //Get hold of elements from the HTML page 
    const navList = document.querySelector("#navList");
    const openIcon = document.querySelector("#openIcon");
    const closeIcon = document.querySelector("#closeIcon");

- To target the element IDs from the *nav-bar.blade.php* we use *document.querySelector*.

    function toggleNav(){
        navList.classList.toggle('hidden')
        openIcon.classList.toggle('hidden')
        closeIcon.classList.toggle('hidden')
    }
- This is a function to toggle visibility of the nav menu.

    openIcon.addEventListener("click", toggleNav);
    closeIcon.addEventListener("click", toggleNav);

- *addEventListener("click", toggleNav)*: this listens when the icon is clicked and calls the *toggleNav()* function, toggling the *hidden* class.
- The first line of code is an event listener for opening the hmaburger menu when it is clicked.
- The second line is an event listener for closing the hamburger menu. 

The *hamburger menu* is in the *nav-bar.blade.php* which looks something like this:

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

- We first have the *Open Icon*. The div element has the *id="openIcon"* Id that is referenced in *app.js* using JavaScript. Then the *svg*  makes three horizontal lines for the hamburger.
- Using Tailwind we make it hidden by default by using *block* and *sm:hidden* makes it hidden on larger screens.
- Then is the *Close Icon* with the *id=closeIcon* Id. The *svg here makes a X symbol. The symbol is hidden by default with *hidden* and becomes visible if the menu is open. 

JavaScript improves user interaction and makes the navigation dynamic without requiring page refreshing.

## Asset Bundling Vite

Vite aims to make the process more efficient and faster. It requires minimal configuration and is easy to set up. We will use Vite to handle the loading of JavaScript hamburger menu and Tailwind CSS. 
First, we must make sure that the Node.js and NPM are installed before running the Vite and the Laravel Plugin. 

We have to install the *Laravel Vite plugin* with the following command: 

    composer require laravel/vite-plugin

Next, we run this command:

    npm install

- This will install dependencies listed in package.json

Laravel plugin is imported as *vite.confing.js*. This file is then modified to handle asset bundling for the application. 

    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';

    export default defineConfig({
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
    });

- *input: ['resources/css/app.css', 'resources/js/app.js']*: here we specify the entry points for Vite to know which files to monitor for bundle and changes. 

The next step is to start the Vite in development mode with the following command:

    npm run dev

- If JavaScript or Tailwind CSS are modified, it will ensure that the changes are applied automatically without refreshing the browser (live reload).

To makes this work we must use *@vite* directive in Blade View. In this case we  include Laravel Vite Plugin to the *layout.blade.php*:

    <head>
    <title>{{$title}}</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

- *@vite(['resources/css/app.css', 'resources/js/app.js'])*: this replaces the *href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet"* which automatically handles the Tailwind Css which is located in the *app.css* and JavaScript located in the *app.js*.
