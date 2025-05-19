import './bootstrap';


//Get hold of elements from the HTML page 
const navList = document.querySelector("#navList");
const openIcon = document.querySelector("#openIcon");
const closeIcon = document.querySelector("#closeIcon");

//toggle the hide css class for these elements
function toggleNav(){
    navList.classList.toggle('hidden')
    openIcon.classList.toggle('hidden')
    closeIcon.classList.toggle('hidden')
}

openIcon.addEventListener("click", toggleNav);
closeIcon.addEventListener("click", toggleNav);

