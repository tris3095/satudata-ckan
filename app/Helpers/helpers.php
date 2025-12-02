<?php

if (! function_exists('group_icon')) {
    function group_icon($name)
    {
        $n = strtolower($name);

        return match (true) {
            str_contains($n, 'ekonomi') => 'bi bi-graph-up',
            str_contains($n, 'industri') => 'bi bi-buildings',
            str_contains($n, 'pendidikan') => 'bi bi-mortarboard',
            str_contains($n, 'kesehatan'), str_contains($n, 'sosial') => 'bi bi-heart-pulse',
            str_contains($n, 'lingkungan') => 'bi bi-tree',
            str_contains($n, 'pemerintahan') => 'bi bi-bank',
            default => 'bi bi-folder',
        };
    }
}
