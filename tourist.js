function showParallelogramText()
{
    var welcomeText = "Witaj w <b> Tourist Helper </b> - webowej aplikacji"
        + " mającej ułatwić podróżowanie! Nie masz pomysłu dokąd wybrać"
        + " się na urlop czy na wakacje? Planujesz weekendowy wypad poza miasto?"
        + " Sprawdź możliwości naszej aplikacji, z nami zaplanujesz swoje najlepsze"
        + " podróże!";
    var text=document.getElementById("parallelogram");
    text.innerHTML=welcomeText;
}


function mouseOnMenu()
{
    var img=document.querySelectorAll(".imgmenu");
    var pages = ["aktualnosci", "zaplanuj", "mapa", "o-nas", "kontakt", "faq"];
    for(let i=0;i<pages.length;i++)
    {
        img[i].style.filter="grayscale(1) blur(5px)";

        img[i].onmouseout=function()
        {
            this.style.filter="grayscale(1) blur(5px)";
        };
        img[i].onmouseover=function()
        {
            this.style.filter="blur(0px)";
            this.style.border="2px solid #A77C00";

        };

        img[i].onclick=function()
        { //test
            window.location.href = pages[i]+ "/";
        };

    }
}


var tmp = document.getElementById("testowe");
window.onload=function()
{
    tmp.oncontextmenu=function(e)
    {
        e.preventDefault();
    };
};

for (var i=-100;i<100 || i%2 == 0;i++){

    console.log("lb: " + i);

}

let article;
function readArticle(id) {
    window.open("czytaj");
    article = id;
}
