/**
 * Created by aude_ on 24/03/2016.
 */

$(document).ready(function () {
    var nbLignes = document.getElementById("tbody_parking").rows.length;
    $('.supprimer').on('click', function () {
        var id = $(this).attr("id");

        nbLignes = nbLignes - 2;
        $(this).parents("tr").remove();
        $("td").filter("#voir_detail_"+id).parent().remove();
        var tr = $("tbody");
        if (nbLignes  < 2) {
            $(tr).html('<tr><td colspan="5" style="text-align:center;">Il n\'existe pas de ligne<td><tr>');
        }
        $.ajax({
            type: "POST",
            url: 'search',
            data: {
                id: id
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
