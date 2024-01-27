<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath(string $path = ''): string
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 */
function loadView(string $name): void
{
    $viewPath = basePath("views/{$name}.view.php");

    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View '{$name} not found!'";
    }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */
function loadPartial(string $name): void
{
    $partialPath = basePath("views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name} not found!'";
    }
}

/**
 * Dump a value
 * 
 * @param mixed $value
 * @return void
 * 
 */
function dump(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

}

/**
 * Dump a value and die 
 * 
 * @param mixed $value
 * @return void
 * 
 */
function dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}