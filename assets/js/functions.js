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
    // ajax pour l'enregistrement de personnages
    // $.get
    // les info du perso sont à mettre dans l'url
    // arriver sur la page de traitement on enregistre
    // dans la table personnage, et surtout su l'arme n'existe pas
    // (comparaison du nom de l'arme) on l'ajoute à la table
    // arme et c'est son id qu'on ajoute au perso
    // si l'arme existe, in faut juste récupérer l'id de l'arme
});
