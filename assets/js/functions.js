function loaded(callable){document.addEventListener("DOMContentLoaded", callable);}
function $(selector){return document.querySelector(selector);}
function $$(selector){return document.querySelectorAll(selector);}
loaded(function(){
    $$(".supJeu").forEach(function (item){
        item.addEventListener("click", function (){
            console.log(this.dataset.idjeu);
            $("#idJeuSup").value = this.dataset.idjeu;
        })
    });
    $("#validSupJeu").addEventListener("click", function (){
            fetch('./src/includes/supJeux.php?idJeu='+$("#idJeuSup").value)
                .then(res => {
                    //console.log("Request complete", res);
                })
            .catch(error => console.log("Erreur : " + error));
    });
});
