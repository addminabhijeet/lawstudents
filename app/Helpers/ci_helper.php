<?php

if (!function_exists('element')) {

    function element($view, $data = [])
    {
        // convert dot/slash support
        $view = str_replace('/', '.', $view);

        // default path where your partials exist
        $path = 'templates.Elements.' . $view;

        if (view()->exists($path)) {
            return view($path, $data)->render();
        }

        // fallback direct view
        if (view()->exists($view)) {
            return view($view, $data)->render();
        }

        return '';
    }
}
