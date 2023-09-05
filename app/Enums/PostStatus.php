<?php

namespace App\Enums;

enum PostStatus: string
{
    case active = "active";
    case inactive = "inactive";
    case archived = "archived";
}
