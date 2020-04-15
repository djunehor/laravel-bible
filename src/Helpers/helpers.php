<?php

if (! function_exists('bible')) {
    function bible($passage): string
    {
        return (new \Djunehor\Logos\Bible())->get($passage);
    }
}
