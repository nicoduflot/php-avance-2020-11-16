$(document).ready(function(){
    $(".supJeu").each(function (item){
        $(this).on("click",function (){
            //console.log();
            $("#idJeuSup").val(this.dataset.idjeu);
        });
    });
    $("#validSupJeu").on("click", function (){
        $.get('./src/includes/supJeux.php?idJeu='+$("#idJeuSup").val(), function (){
        }).then(function (){
            $("#resUpdateJeux-"+$("#idJeuSup").val()).css("display", "none");
            $("#resUpdateJeux-"+$("#idJeuSup").val()).css("visibility","hidden");
            $("#modalSup").modal('toggle');
        });
    });

    $("#enregPerso").on("click", function (){
        let perso = $(".enregPerso").text();
        console.log('./enregPerso.php?json='+perso);
        $.get('./enregPerso.php?json='+perso, function (){

        }).then(function (){
            window.location.replace("../../classesetpdo.php");
        });

    });
});
