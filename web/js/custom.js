$(document).ready(function () {
     var nbLignes = document.getElementById("tab_body_plaintes").rows.length;
   $('.supprimer').on('click', function () {
        var id = $(this).attr("id");
       
        nbLignes = nbLignes - 2;
        $(this).parents("tr").remove();
        $("td").filter("#voir_message_"+id).parent().remove();
        var tr = $("tbody");
        if (nbLignes  < 2) {
            $(tr).html('<tr><td colspan="4" style="text-align:center;">Aucune ligne trouvée<td><tr>');
        }
       $.ajax({
        type: "POST",
        url: 'plaintes',
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
});
