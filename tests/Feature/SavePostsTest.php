<?php
namespace sharkas\Press\Tests;

use function factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use sharkas\Press\Models\Post;


class SavePostsTest extends \sharkas\Press\Tests\TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_can_be_created_with_the_factory()
    {
        $post = factory(Post::class)->create();
        $this->assertCount(1,Post::all());
    }

}