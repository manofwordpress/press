<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 07/06/2020
 * Time: 7:03 AM
 */

namespace sharkas\Press\Fields;

use function json_decode;
use function json_encode;


class Extra extends FieldContract
{
    public static function process($type,$value,$data)
    {
        $extra = isset($data['extra']) ? (array) json_decode($data['extra']) : [];

        return [
               'extra' => json_encode(array_merge($extra,[
                   $type => $value
               ]))
            ];
    }
}