<?php

use App\Support\ResponseErrorMessages;
use Illuminate\Support\Str;

function error_if($assert, string $errorMessageBag, array $additional = [])
{
    if (!$assert) {
        return;
    }

    return error($errorMessageBag, $additional);
}

function error(string $errorMessageBag, array $additional = [])
{
    $class = get_class(new ResponseErrorMessages());
    $messageBag = constant("$class::$errorMessageBag");

    return abort(
        response(['success' => false] + $messageBag + $additional, $messageBag['code']),
    );
}

function currentUser()
{
    return auth('api')->user();
}

function authUser()
{
    return currentUser();
}

function getClassName($object)
{
    $classNameWithNamespace = get_class($object);

    return substr($classNameWithNamespace, strrpos($classNameWithNamespace, '\\')+1);
}
