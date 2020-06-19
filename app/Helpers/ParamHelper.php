<?php

namespace App\Helpers;

class ParamHelper
{
    const SORT_VALID_VALUES = ['asc', 'ASC', 'desc', 'DESC'];

    /**
     * @param string $sortParam
     * @return string
     */
    public static function validateSort(string $sortParam): string
    {
        if (!in_array($sortParam, self::SORT_VALID_VALUES)) {
            return 'asc';
        }

        return $sortParam;
    }

    /**
     * @param string $param
     * @return string
     */
    public static function getFieldByParam(string $param): string
    {
        switch ($param) {
            case 'author':
                return 'authors.last_name';
            case 'category':
                return 'categories.title';
            default:
                return 'books.title';
        }
    }
}
