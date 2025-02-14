
$("#adicionar-livro").on('click', function(){
    $("#modal").get(0).classList.remove("sumida");
    $("#modal").get(0).classList.add("aparecida");
});


$("#fechar").on('click', function(){
   $("#modal").get(0).classList.remove("aparecida");
   $("#modal").get(0).classList.add("sumida");
});

window.addEventListener('click', function(event){
    if (event.target == $("#modal").get(0)) {
       $("#modal").get(0).classList.remove("aparecida");
       $("#modal").get(0).classList.add("sumida");
    }
});
