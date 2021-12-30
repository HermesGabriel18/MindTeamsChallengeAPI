<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Used by Controller that manage Polymorphic models (as Disabled) when face 'update' method.
 * This route has the form as '<type>/<id>/model'. So, this method helps to determine the class name of the model
 * by the <type> passed in the url.
 *
 * @param string $type
 *
 * @return string string
 */
function classByString(string $type): string
{
    return Str::of($type)
        ->singular()
        ->studly()
        ->start('App\\Models\\')
        ->__toString();
}


/**
 * Translate given attribute name
 *
 * @param $attribute
 * @return string
 */
function tValidation($attribute): string
{
    return trans("validation.attributes.$attribute");
}

/**
 * Translate a Model name, useful for Constants Models.
 *
 * @param Model|null $model
 * @return string|null
 */
function tName(?Model $model = null): ?string
{
    if (!$model) {
        return null;
    }

    $modelName = Str::snake(class_basename($model));
    $name = Str::lower($model->name);

    return trans("models.$modelName.$name");
}

/**
 * Translate a Model
 *
 * @param string $model
 * @param bool $plural
 * @return string
 */
function modelTitle(string $model, $plural = false): string
{
    $modelName = Str::snake(class_basename($model));

    return trans_choice("models.$modelName.$modelName", $plural ? 2 : 1);
}

/**
 * Dates must be always have formats 'Y-m-d' or 'Y/m/d'
 * @param $value
 * @return bool
 */
function isDateString($value): bool
{
    return $value
        && !is_numeric($value)
        && (substr_count($value, '-') === 2 || substr_count($value, '/') === 2);
}