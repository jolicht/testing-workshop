<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\User;

interface SendUserInvitationDecider
{
    public function hasSendInvitationPermission(User $user): bool;
}