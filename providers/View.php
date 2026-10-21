<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Fournisseur de vues : charge les templates Twig et gère les redirections
class View {
    static public function render(string $template, $data = []){
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        echo $twig->render($template.".php", $data);
    }

    static public function redirect(string $url){
        header('location:'.BASE.'/'.$url);
    }

}
?>
