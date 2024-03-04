<?php

function isActive(string|array $name): string
{
    return request()->routeIs($name) ? 'underline text-rose-400' : '';
}
