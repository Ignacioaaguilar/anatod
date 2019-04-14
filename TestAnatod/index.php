<?php
require_once ('bussiness/cliente.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Anatod</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
  </script>

<script>
  $.fn.pageMe = function(opts){
 var $this = this,
     defaults = {
         perPage: 25,
         showPrevNext: false,
         hidePageNumbers: false
     },
     settings = $.extend(defaults, opts);

 var listElement = $this.find('tbody');
 var perPage = settings.perPage;
 var children = listElement.children();
 var pager = $('.pager');

 if (typeof settings.childSelector!="undefined") {
     children = listElement.find(settings.childSelector);
 }

 if (typeof settings.pagerSelector!="undefined") {
     pager = $(settings.pagerSelector);
 }

 var numItems = children.size();
 var numPages = Math.ceil(numItems/perPage);

 pager.data("curr",0);

 if (settings.showPrevNext){

     $('<li><a href="#" class="prev_link"> «</a></li>').appendTo(pager);
 }

 var curr = 0;
 while(numPages > curr && (settings.hidePageNumbers==false)){
     $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
     curr++;
 }

 if (settings.showPrevNext){
     $('<li><a href="#" class="next_link"> »</a></li>').appendTo(pager);
 }

 pager.find('.page_link:first').addClass('active');
 pager.find('.prev_link').hide();
 if (numPages<=1) {
     pager.find('.next_link').hide();
 }
 pager.children().eq(1).addClass("active");

 children.hide();
 children.slice(0, perPage).show();

 pager.find('li .page_link').click(function(){
     var clickedPage = $(this).html().valueOf()-1;
     goTo(clickedPage,perPage);
     return false;
 });
 pager.find('li .prev_link').click(function(){
     previous();
     return false;
 });
 pager.find('li .next_link').click(function(){
     next();
     return false;
 });

 function previous(){
     var goToPage = parseInt(pager.data("curr")) - 1;
     goTo(goToPage);
 }

 function next(){
     goToPage = parseInt(pager.data("curr")) + 1;
     goTo(goToPage);
 }

 function goTo(page){
     var startAt = page * perPage,
         endOn = startAt + perPage;

     children.css('display','none').slice(startAt, endOn).show();

     if (page>=1) {
         pager.find('.prev_link').show();
     }
     else {
         pager.find('.prev_link').hide();
     }

     if (page<(numPages-1)) {
         pager.find('.next_link').show();
     }
     else {
         pager.find('.next_link').hide();
     }

     pager.data("curr",page);
     pager.children().removeClass("active");
     pager.children().eq(page+1).addClass("active");

 }
};

$(document).ready(function(){

$('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:10});

});

</script>

  </head>
  <body id=ColorFondo >
    <h1> Clientes </h1>
      <a href="agregar.php" title="Agregar Clientes" class="enlaceboton">Agregar</a>
      <div class="blanco"></div>
    <table border="1" class="blueTable" id="myTable">
      <thead>
  		    <tr>
      			<th># Cliente</th>
      			<th>Nombre de cliente</th>
            <th>Dni de cliente</th>
            <th>Localidad</th>
            <th>Editar</th>
          </tr>
      </thead>
      <tbody
      <?php
        $cli =new Cliente();
        $result=  $cli->getAll();
        while($row =$result->fetch_assoc()){
          echo ("<tr>");
          echo ("<td>". $row["id"]  ."</td>");
          echo ("<td>". $row["Nombre_CLI"]  ."</td>");
          echo ("<td>". $row['dni']  ."</td>");
          echo ("<td>". $row['nombre']  ."</td>");
          echo ("<td> <a href=modificar.php?id=".$row['id'].". title='Modificar Clientes' ><img src='imagen/editar.ico'></a></td>");
          echo ("</tr>");
          }
          ?>
      </tbody>
		</table>
    <div class="blanco"></div>
    <ul id="myPager" style="display:inline;"></ul>
     <hr>

     <?php
       if(!empty($_GET['mensaje'])){
         $mensaje  =$_GET['mensaje'];
           if ($mensaje=="succcess"){
             ?>
             <div id="dialog" title="Modificar Clientes">
                 <p>El Cliente, se Modifico Exitosamente</p>
             </div>
           <?php
               }
           else if ($mensaje=="failed") {
             ?>
             <div id="dialog" title="Modificar Clientes">
                 <p>Hubo un error, el cliente no se pudo Modificar</p>
             </div>
             <?php
           }
         }
      ?>
  </body>
</html>
