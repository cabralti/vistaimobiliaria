<?php

if (!function_exists('url')) {
    /**
     * @param string|null $path
     * @return string
     */
    function url(string $path = null): string
    {
        if ($path) {
            return APP_BASE . "/{$path}";
        }

        return APP_BASE;
    }
}


if (!function_exists('theme')) {
    /**
     * @param string|null $path
     * @return string
     */
    function theme(string $path = null): string
    {
        if ($path) {
            return APP_BASE . "/templates/" . APP_THEME . "/{$path}";
        }

        return APP_BASE . "/templates/" . APP_THEME;
    }
}
