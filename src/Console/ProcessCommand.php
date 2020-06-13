<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 12/06/2020
 * Time: 6:04 PM
 */

namespace sharkas\Press\Console;


use function config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function is_null;
use function json_encode;
use sharkas\Press\Models\Post;
use sharkas\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Update blog posts.';

    public function handle()
    {
        //$this->info('Hello !');

        if(is_null(config('press'))){
            return $this->warn('pelase publish the config file by running'.
            '\'php artisan vendor:publish --tag=press-config\'');
        }
        // Fetch All Posts
        // Process each file
        // Store To DB

        $files = File::files(config('press.path'));
        foreach($files as $file){
            $post = (new PressFileParser($file))->getData();
        }

        $extra = $post['extra'] ?? [];
        Post::create([
            'identifier' => Str::random(),
            'slug' => Str::slug($post['title']),
            'title' => $post['body'],
            'extra' => json_encode($extra),
        ]);

    }
    
}