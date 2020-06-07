<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 06/06/2020
 * Time: 2:21 PM
 */

namespace sharkas\Press;


use Parsedown;

class MarkdownParser
{
    public static function parse($string)
    {
        return Parsedown::instance()->text($string);
    }
}