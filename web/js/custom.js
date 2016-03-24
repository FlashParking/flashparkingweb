var myFunc = {
    delete:
        function(id_table, url_page, colspan) {
            var element = $('#'+id_table);
            if(element.length){
                 var nbLignes = document.getElementById(id_table).rows.length;
                    if (nbLignes < 2) {
                         $("tbody").html('<tr><td colspan="'+colspan+'" style="text-align:center;">Aucune ligne trouvée<td><tr>');
                    }
               $('.supprimer').on('click', function () {
                    var id = $(this).attr("id");

                    nbLignes = nbLignes - 2;
                    $(this).parents("tr").remove();
                    $("td").filter("#voir_message_"+id).parent().remove();
                    var tr = $("tbody");
                    if (nbLignes  < 2) {
                        $(tr).html('<tr><td colspan="'+colspan+'"style="text-align:center;">Aucune ligne trouvée<td><tr>');
                    }
                   $.ajax({
                    type: "POST",
                    url: url_page,
                    data: {
                        id_message: id
                    },
                    error: function() {
                        console.log("Erreur AJAX");
                    },
                    success: function(data) {
                       console.log("A success");
                    }
                });
            });
        }
    }
};
   
myFunc["delete"]("tab_body_plaintes", "plaintes", "4");
myFunc["delete"]("tab_body_reservations", "reservations", "5");