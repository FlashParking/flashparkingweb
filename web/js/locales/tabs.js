/**
 * Created by Virginie on 18/04/2016.
 */
var activeTab = null;
var titreMOdal = null;
$(document).ready(function() {
   activeTab = $.cookie("activeTab")
   if(activeTab != null) {
      if (activeTab == "tarifsManagerTab") {
         tabTarifs();
      }
      if (activeTab == "offresManagerTab") {
         tabOffres();
         titreMOdal = "Ajouter une offre";
      }
      if (activeTab == "promotionsManagerTab") {
         tabPromos();
         titreMOdal = "Ajouter une promotion";
      }
   }

   $(document).on('click', '.js-tarif-submit', function (event) {
      event.preventDefault();
      // Récupère l'action à effectuer
      var actionqqch = document.getElementById("myModal").getAttribute("data-action");
      // Récupère l'id
      var id = document.getElementById("myModal").getAttribute("data-id");
      var data = $('form[name="tarif"]').serializeArray();
      data.push({'name':'action', 'value':actionqqch});
      data.push({'name':'id', 'value':id});
      $.ajax({
         type:'POST',
         url:'formManager',
         data: data,
         success: function(response) {
            if(response.state) {
               var html = '';
               html = getTarifHtml(response.objet, response.deleteUrl);
               document.getElementById('addTarifButton').innerHTML += html;
               $('.js-request-state').html('<div class="alert alert-success">L\'action a bien été effectuée.</div>');
               $('#myModal').modal('hide');
            }else{
            $('.modal-content-body').html(response.html);
   }
         }});
   });

   $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var actionValue = button.attr('title');
      var id = button.attr('id');
      var idValue = button.text();

      if(actionValue == "INSERT") {
         $.ajax({
            type: 'GET',
            url: 'formManager',
            success: function (response) {
               var element = document.getElementById("myModal");
               element.setAttribute("data-action", "INSERT");
               $(".modal-title").html(idValue);
               $(".modal-content-body").html(response.html);
               $('#myModal').open;
            }
         });
      } else {
         if(actionValue == "UPDATE"){
            $.ajax({
               type: 'POST',
               url: 'formManager',
               data : {action : actionValue,
                        id : id},
               dataType: "JSON",
               success: function (response) {
                  console.log(response);
                  var element = document.getElementById("myModal");
                  element.setAttribute("data-action", "UPDATE");
                  element.setAttribute("data-id", response.objet.id);
                  var modal = $(this);
                  $(".modal-title").html(idValue);
                  $(".modal-content-body").html(response.html);
                  $('#myModal').open;
               }
            });
         }
      }
   })


});



/** FONCTIONS */
function tabTarifs() {
   $('#tarifsManagerTab').css("font-weight","bold");
   $('#offresManagerTab').css("font-weight","normal");
   $('#promotionsManagerTab').css("font-weight","normal");
   $('#tarifsManager').css("display","block");
   $('#offresManager').css("display","none");
   $('#promotionsManager').css("display","none");
   $.cookie("activeTab", "tarifsManagerTab");
}

function tabOffres() {
   $('#offresManagerTab').css("font-weight","bold");
   $('#tarifsManagerTab').css("font-weight","normal");
   $('#promotionsManagerTab').css("font-weight","normal");
   $('#tarifsManager').css("display","none");
   $('#offresManager').css("display","block");
   $('#promotionsManager').css("display","none");
   $.cookie("activeTab", "offresManagerTab");
}

function tabPromos() {
   $('#promotionsManagerTab').css("font-weight","bold");
   $('#tarifsManagerTab').css("font-weight","normal");
   $('#offresManagerTab').css("font-weight","normal");
   $('#tarifsManager').css("display","none");
   $('#offresManager').css("display","none");
   $('#promotionsManager').css("display","block");
   $.cookie("activeTab", "promotionsManagerTab");
}

/* Mise en forme HTML du tarif
* Pour pouvoir l'ajouter dans le HTML
* Sans avoir à recharger la page
*/
function getTarifHtml(tarif, deleteUrl){
   var url = window.location.pathname;
   html = '' +
   '<h2>'+tarif['libelle']+'</h2>' +
   '<strong>Description : </strong>' +
   tarif['description'] +
   '<br/>' +
   '<strong>Prix : </strong>' +
       tarif['prix'] +
   '€' +
   '<div class="buttonsUpDel"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" data-whatever="Modifier un tarif">Modifier</button>' +
       '<a href='+deleteUrl+'>'+
         '<button class="btn btn-danger">Supprimer</button>'
      '</a></div>';
   return html;
}

