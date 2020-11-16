<?php
//la fonction de chargement des classes
function loadClass($class){
    require "./src/Classes/".$class.".php";
}
// spl reconnaît l'utilisation d'une classe, il va donc exécuter la fonction
// loadCLass avec comme paramètre le nom de la classe qu'il a repérer
spl_autoload_register('loadClass');
