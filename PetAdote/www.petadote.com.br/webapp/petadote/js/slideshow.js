function setaImagem(){

    var settings = {
        primeiraImg: function(){
            elemento = document.querySelector("#slider .trs:first-child");
            elemento.classList.add("ativo");
        },

        slide: function(){
            elemento = document.querySelector("#slider .ativo");

            if(elemento.nextElementSibling){
                elemento.nextElementSibling.classList.add("ativo");
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }

        },

        proximo: function(){
            clearInterval(intervalo);
            elemento = document.querySelector("#slider .ativo");

            if(elemento.nextElementSibling){
                elemento.nextElementSibling.classList.add("ativo");
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }
            intervalo = setInterval(settings.slide, 9000);
        },

        anterior: function(){
            clearInterval(intervalo);
            elemento = document.querySelector("#slider .ativo");

            if(elemento.previousElementSibling){
                elemento.previousElementSibling.classList.add("ativo");
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                elemento = document.querySelector("#slider .trs:last-child");
                elemento.classList.add("ativo");
            }
            intervalo = setInterval(settings.slide, 9000);
        },

    }

    //chama o slide
    settings.primeiraImg();


    //chama o slide à um determinado tempo
    var intervalo = setInterval(settings.slide, 9000);
    document.querySelector(".next").addEventListener("click",settings.proximo,false);
    document.querySelector(".prev").addEventListener("click",settings.anterior,false);
}


setaImagem();
