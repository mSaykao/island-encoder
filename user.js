function slideshow(){
    var slideshow = document.getElementById("slideshow"),
    imgs = slideshow.getElementsByTagName("img"),
    page = slideshow.getElementsByTagName("span"),
    current = 0;

    function slidesOff(){
        imgs[current].className = "";
        page[current].className = "";
    }

    function slidesOn(){
        imgs[current].className = "active";
        page[current].className = "active";
    }

    function changeSlide(){
        slidesOff();
        current++;
        if(current>=9){
            current = 0;
        }
        slidesOn();
    }

    var slideon = setInterval(changeSlide,2000)

    slideshow.onmouseover = function(){
        clearInterval(slideon);
    }

    slideshow.onmouseout = function(){
        slideon = setInterval(changeSlide,2000)
    }

    for(var i = 0;i<page.length;i++){
        page[i].onmouseover = function(){
            slidesOff();
            current = this.innerHTML-1;
            slidesOn();
        }
    }



}

function slideshow1(){
    var slideshow = document.getElementById("slideshow1"),
    imgs = slideshow.getElementsByTagName("img"),
    page = slideshow.getElementsByTagName("span"),
    current = 0;

    function slidesOff(){
        imgs[current].className = "";
        page[current].className = "";
    }

    function slidesOn(){
        imgs[current].className = "active1";
        page[current].className = "active1";
    }

    function changeSlide(){
        slidesOff();
        current++;
        if(current>=9){
            current = 0;
        }
        slidesOn();
    }

    var slideon = setInterval(changeSlide,2000)

    slideshow.onmouseover = function(){
        clearInterval(slideon);
    }

    slideshow.onmouseout = function(){
        slideon = setInterval(changeSlide,2000)
    }

    for(var i = 0;i<page.length;i++){
        page[i].onmouseover = function(){
            slidesOff();
            current = this.innerHTML-1;
            slidesOn();
        }
    }



}

slideshow();
slideshow1();

const themeToggler = document.querySelector('.theme-toggler');
themeToggler.addEventListener('click',() => {
    document.body.classList.toggle('dark-theme-variables')

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})




