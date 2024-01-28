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
 * @param array $data
 * @return void
 * 
 */
function loadView(string $name, array $data = []): void
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
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
function loadPartial(string $name, array $data = []): void
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
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

/**
 * Format salary
 * 
 * @param string $salary
 * @return string Formated Salary
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}

/**
 * Sanitize Data
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
