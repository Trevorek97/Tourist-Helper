function showParallelogramText()
{
    var welcomeText = "Witaj w <b> Tourist Helper </b> - aplikacji"
        + " mającej ułatwić podróżowanie! Nie masz pomysłu dokąd wybrać"
        + " się na urlop czy na wakacje? Planujesz weekendowy wypad poza miasto?"
        + " Sprawdź możliwości naszej aplikacji, z nami zaplanujesz swoje najlepsze"
        + " podróże!";
    var text=document.getElementById("parallelogram");
    text.innerHTML=welcomeText;
}


function mouseOnMenu(status)
{
    var img=document.querySelectorAll(".imgmenu");
    if(status == '2') {
        var pages = ["aktualnosci", "events", "guide", "trip", "mapa", "o-nas", "kontakt", "faq"];
    } else if (status=='1') {
        var pages = ["aktualnosci", "events", "guide", "trip", "mapa", "o-nas", "kontakt", "faq", "adminpanel"];
    } else if (status =='0') {
        var pages = ["aktualnosci", "guide", "mapa", "o-nas", "kontakt", "faq"];
    }

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

