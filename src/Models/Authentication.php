<?php

namespace HaiPhan\BaseL7\Models;

use App\BaseL7\Filters\Traits\CanSearch;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class Authentication extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use Notifiable;
    use CanSearch;
}
