$( document ).ready(function() {
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("default").click();
  $("body").on("click",".remove-tag",function(){
    var id = $(this).parent("td").data('id');
    console.log(id);
    var c_obj = $(this).parents("tr");

    $.ajax({
      type:'POST',
      url: 'http://localhost/Practica_11/php/deleteTag.php',
      data:{id:id},
      success: function(data){
                  alert("Objeto borrado"); // Alert the results
                }
              }).done(function(data){
                c_obj.remove();
              });
            });

  $("body").on("click",".remove-sec",function(){
    console.log(id);
    var id = $(this).parent("td").data('id');
    console.log(id);
    var c_obj = $(this).parents("tr");

    $.ajax({
      type:'POST',
      url: 'http://localhost/Practica_11/php/deleteSection.php',
      data:{id:id},
      success: function(data){
                  alert("Objeto borrado"); // Alert the results
                }
              }).done(function(data){
                c_obj.remove();
              });
            });
});

$(document).on('show.bs.modal','#editSectionModal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id = button.data('id');
  $('#editIDSeccion').val(id);
  var titulo= button.data('titulo'); 
  $('#editTituloSeccion').val(titulo);
  var fechaPublicacion = button.data('fechaPub');
  $('#editfechaPublicacion').val(fechaPublicacion);
  var contenidoSeccion= button.data('contenido'); 
  $('#editContenidoSeccion').val(contenidoSeccion);
  var fuente= button.data('fuente');
  $('#editFuenteContenido').val(fuente);
  var URLImagen= button.data('ilustracion'); 
  $('#editUrlImagen').val(URLImagen);
});

$(document).on('show.bs.modal','#editTagModal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id = button.data('id');
  $('#editIDEtiqueta').val(id);
  var nombre= button.data('nombre');
  $('#editNombreEtiqueta').val(nombre);
});


function openTab(e, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  e.currentTarget.className += " active";
}


$("body").on("click",".remove-sec",function(){
  console.log(id);
  var id = $(this).parent("td").data('id');
  console.log(id);
  var c_obj = $(this).parents("tr");

  $.ajax({
    type:'POST',
    url: 'http://localhost/Practica_11/php/deleteSection.php',
    data:{id:id},
    success: function(data){
                  alert("Objeto borrado"); // Alert the results
                }
              }).done(function(data){
                c_obj.remove();
              });
            });

$("body").on("click",".edit-sec",function(){
  console.log("holiii");
  var c_obj = $(this).parents("tr");

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: 'http://localhost/Practica_11/php/editSection.php',
    data:{id:id},
    error: function() {
      console.log("I'm hitting an error.");
    },
    success: function(data){
                  alert("Objeto borradokjhkjhkjhkjhk"); // Alert the results
                }
              }).done(function(data){
                c_obj.remove();
              });
            });

$( "#editSection" ).submit(function( event ) {
  console.log("HII");
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "editSection.php",
    data: parametros,
  });
  event.preventDefault();
});
