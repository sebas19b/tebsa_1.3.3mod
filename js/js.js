function confirdelar(nob){	
    
    var mensaconfir = confirm("¿Desea eliminar la carpeta?");
    
    
    if (mensaconfir = true){

        $.ajax({
           type:"POST",
           url:"eli.php",
           dataType:"HTML",
           data:{
                x:log(nob.id)
            },
             success:function(datos){
                     $('#condel').html(datos)
             },
          error: function ( jqXHR, textStatus, errorThrown ){
                  alert (errorThrown);
             }

    })

    }
}

