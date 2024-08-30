<?php

namespace App\Enum;

enum DebtStatusEnum: int
{
    case Pendente = 1;
    case Pago = 2;
    case Atrasado = 3;
}
