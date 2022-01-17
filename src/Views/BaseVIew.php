<?php

declare(strict_types=1);

namespace Ilyamur\PhpOnRails\Views;

class BaseView
{
    public static function renderTemplate(string $template, array $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(__DIR__);
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template . '.html.twig', $args);
    }
}
