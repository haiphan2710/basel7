<?php

namespace HaiPhan\BaseL7\Models;

use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use HaiPhan\BaseL7\Cores\Role\HasRole;
use HaiPhan\BaseL7\Filters\Traits\CanSearch;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Authentication extends Authenticatable
{
    use HasRole;
    use HasApiTokens;
    use Notifiable;
    use CanSearch;
}
