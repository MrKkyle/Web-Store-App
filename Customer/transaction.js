let model = document.getElementById("transaction");
let button = document.querySelectorAll(".button");
let amount = document.querySelector(".tr_amt");
let price = document.querySelectorAll(".price");

for(let i = 0; i < button.length; i++)
{
    button[i].onclick = function(event)
    {
        if(button[i].onclick)
        {
            amount.innerHTML = price[i].innerHTML;
            model.style.display = "block";
        }
    }
}

let background = document.querySelector(".card-container");

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

