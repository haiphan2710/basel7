<?php

namespace HaiPhan\BaseL7\Models;

use App\BaseL7\Filters\Traits\CanSearch;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use CanSearch;
}
