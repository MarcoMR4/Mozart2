$(function(){

    //alert("funciona...")
    
    $("#cerrar").click(function(){
       var respuesta = confirm("Deseas salir?")
       if(respuesta==false){
            event.preventDefault();
       }
    });

  
});