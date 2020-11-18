$(document).ready(function(){
    $(".supJeu").each(function (item){
        $(this).on("click",function (){
            console.log();
            $("#idJeuSup").val(this.dataset.idjeu);
        });
    });
    $("#validSupJeu").on("click", function (){
        $.get('./src/includes/supJeux.php?idJeu='+$("#idJeuSup").val(), function (){
            console.log('./src/includes/supJeux.php?idJeu='+$("#idJeuSup").val());
            console.log("jeu supprimé");
        });
        $("#resUpdateJeux-"+$("#idJeuSup").val()).css("display", "none");
        $("#resUpdateJeux-"+$("#idJeuSup").val()).css("visibility","hidden");
        $("#modalSup").modal('toggle');
    });
});
