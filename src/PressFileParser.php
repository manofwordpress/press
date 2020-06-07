<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 06/06/2020
 * Time: 2:41 PM
 */

namespace sharkas\Press;


use function array_merge;
use Carbon\Carbon;
use function class_exists;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function method_exists;
use function title_case;

class PressFileParser
{
    protected $filename;
    protected $data;

    /**
     * PressFileParser constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->splitFile();
        $this->explodeData();
        $this->processFields();
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match
        (
            '/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->data
        );
    }

    protected function explodeData()
    {
        foreach(explode("\n",trim($this->data[1])) as $fieldString)
        {
            preg_match('/(.*):\s?(.*)/s', $fieldString, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }

        $this->data['body'] = trim($this->data[2]);
    }

    protected function processFields()
    {
        foreach($this->data as $field=>$value)
        {
/*            if($field === 'date')
            {
                $this->data[$field] = Carbon::parse($value);
            }elseif($field === 'body')
            {
                $this->data[$field] = MarkdownParser::parse($value);
            }*/


            $class = 'sharkas\\Press\\Fields\\'.Str::title($field);

            if(class_exists($class) && method_exists($class,'process'))
            {
                $this->data = array_merge($this->data,$class::process($field,$value));
            }

        }

        dd($this->data);
    }


}