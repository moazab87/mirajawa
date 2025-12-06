<?php

namespace App\Enums;

enum RoleTypeEnum: int
{
    case MEMBER = 1;
    case LEADER = 2;
    case ADMIN  = 3;
}
