<?php

use Illuminate\Support\Str;

function slug_format($string)
{
    return Str::slug($string);
}
