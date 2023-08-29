let buttons = document.querySelectorAll(".button5");
let info = document.querySelectorAll(".database-div");
let edit = document.getElementById("edit");

for(let i = 0; i < buttons.length; i++)
{
    buttons[i].onclick = function(event)
    {
        if(buttons[i].onclick)
        {
            edit.style.display = "none";
            info[i].style.display = "block";
        }
    }
}

/* Close Buttons */
let closeButton = document.querySelectorAll(".close");

for(let i = 0; i < closeButton.length; i++)
{
    closeButton[i].onclick = function(event)
    {
        if(closeButton[i].onclick)
        {
            edit.style.display = "block";
            info[i].style.display = "none";
        }
    }
}

/* Products page */ 

let product_buttons = document.querySelectorAll(".button-products");
let msg = document.querySelector(".message");

for(let i = 0; i < product_buttons.length; i++)
{
    product_buttons[i].onclick = function(event)
    {
        if(product_buttons[i].onclick)
        {
            msg.style.animation = "fadeIn 1s ease-in";
            msg.style.display = "block";
            setTimeout(() =>
            {
                msg.style.opacity = "1";
            }, 1000);
            setTimeout(() =>
            {
                msg.style.animation = "fadeOut 1s ease-out";

                setTimeout(() =>
                {
                    msg.style.display = "none";
                    msg.style.opacity = "0";
                }, 800);
            }, 5000);
        }
    }
}

/* Background */ 
let background = document.querySelector(".background-image");

var colors = ['rgba(0,0,0,0.2)', 'rgba(52, 165, 150, 0.2)'];
var currentIndex = 0;
setInterval(function () 
{
   background.style.backgroundColor = colors[currentIndex];

   if (!colors[currentIndex]) {
       currentIndex = 0;
   } else {
       currentIndex++;
   }
}, 1500);








