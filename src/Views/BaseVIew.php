<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Views;

class BaseVIew
{
    public static function renderTemplate(string $template, array $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../src/Views');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template . '.html.twig', $args);
    }
}
