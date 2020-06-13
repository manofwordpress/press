<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 07/06/2020
 * Time: 7:03 AM
 */

namespace sharkas\Press\Fields;


use Carbon\Carbon;

class Date extends FieldContract
{
    public static function process($type,$value,$data)
    {
        return [
                $type => Carbon::parse($value),
                'parsed_at' => Carbon::now()
            ];
    }
}