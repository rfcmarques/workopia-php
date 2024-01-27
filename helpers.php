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