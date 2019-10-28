var title = document.getElementById("title");
var welcomeText = "Witaj w <b> Tourist Helper </b> - webowej aplikacji"
    + " mającej ułatwić podróżowanie! Nie masz pomysłu dokąd wybrać"
    + " się na urlop czy na wakacje? Planujesz weekendowy wypad poza miasto?"
    + " Sprawdź możliwości naszej aplikacji, z nami zaplanujesz swoje najlepsze"
    + " podróże!";
title.addEventListener("click", function()
{
    location.href="mainpage.html";
});
function showParallelogramText()
{
    var text=document.getElementById("parallelogram");
    text.innerHTML=welcomeText;
}