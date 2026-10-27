<?php

namespace App;

enum EmailStatus: string
{
    case PENDING = 'pending';
    case SENT = 'sent';
}
