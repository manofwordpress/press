<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 07/06/2020
 * Time: 7:03 AM
 */

namespace sharkas\Press\Fields;

use sharkas\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type,$value,$data)
    {
        return [
                $type => MarkdownParser::parse($value),
            ];
    }
}