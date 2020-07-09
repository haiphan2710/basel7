<?php

namespace HaiPhan\BaseL7\Exceptions;

use Exception;

class AccountLoggedInException extends Exception
{
    protected $message = 'ACCOUNT_LOGGED_IN';

    protected $code = 401;
}
