$(document).ready(function () {
   $('.supprimer').on('click', function () {
    var id = $(this).attr("id");
    //alert(id);
       //function test(id) {
       $.ajax({
        type: "POST",
        url: 'plaintes',
        data: {
            test: id
        },
        error: function() {
            console.log("AAAAAAH");
        },
        success: function(data) {
            //console.log(response);
            alert("Message supprimé !");
            console.log("Youuuhouu");
            //console.log(id);
            console.log(data);   
        }
    });
   });
});
/*   
$(document).ready(function () {
   $('.supprimer').on('click', function () {
    var id = $(this).attr("id");
       test(id);
});
});*/