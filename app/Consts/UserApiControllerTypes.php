<?php

namespace App\Consts;

class UserApiControllerTypes
{
    public const RESOURCE_USER = 'user';
    public const RESOURCE_MESSAGE = 'message';
    public const RESOURCE_TOKEN = 'UserAccessToken';
    public const RESOURCE_ERROR = 'error';
    public const RESOURCE_MESSAGE_DELETE = 'Recipe soft-deleted successfully';
    public const RESOURCE_MESSAGE_RESTORE = 'Recipe restored successfully';
    public const RESOURCE_MESSAGE_TOKEN_CREATE = 'Access token created successfully';
    public const RESOURCE_MESSAGE_ERROR_LOGIN = 'Invalid email or password';
}