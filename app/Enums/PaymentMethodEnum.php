<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class PaymentMethodEnum extends Enum
{
    const WalletId = 4;
    const DiscountId = 6;
    const CashId = 1;
}
