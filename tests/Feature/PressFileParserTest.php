<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 06/06/2020
 * Time: 2:47 PM
 */

namespace sharkas\Press\Tests;


use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use sharkas\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertContains('title: My Title',$data[1]);
        $this->assertContains('description: Description here',$data[1]);
        $this->assertContains('Blog post body here',$data[2]);
    }

    /** @test */
    public function string_can_be_used_instead()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: My Title\n---\nBlog post body here"));

        $data = $pressFileParser->getData();

        $this->assertContains('title: My Title',$data[1]);
        $this->assertContains('Blog post body here',$data[2]);
    }

    /** @test */
    public function each_head_field_gets_separate()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('My Title',$data['title']);
        $this->assertEquals('Description here',$data['description']);

    }

    /** @test */
    public function the_body_get_saved_and_trimmed()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        //$this->assertEquals("# Heading\n\nBlog post body here",$data['body']);
        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>",$data['body']);
    }

    /** @test */
    public function date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: April 1,1986\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class,$data['date']);
        $this->assertEquals('01-04-1986',$data['date']->format('d-m-Y'));
    }

}