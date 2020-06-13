<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 07/06/2020
 * Time: 12:14 PM
 */

namespace sharkas\Press\Fields;



abstract class FieldContract
{
    public static function process($fieldType,$fieldValue,$data)
    {
        return [$fieldType=>$fieldValue];
    }
}