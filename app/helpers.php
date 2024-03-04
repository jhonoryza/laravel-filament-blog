<?php

function isActive(string|array $name): string
{
    return request()->routeIs($name) ? 'text-rose-400' : '';
}
