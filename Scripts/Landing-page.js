/* Slideshow */
let slideIndex = 0;
showSlides();

function showSlides() 
{
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) 
    {
    slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(() =>
    {
        showSlides();
    }, 3000); // Change image every 2 seconds
}

let message = document.querySelector(".welcome-msg");


window.addEventListener("load", event =>
{
    setTimeout(() =>
    {
        message.style.display = "block";
        setTimeout(() =>
        {
            message.style.animation = "fadeOut 1s ease-in forwards";
            message.style.opacity = "0";
        }, 2000);
    }, 2000);
})


