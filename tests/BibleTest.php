<?php

namespace Djunehor\Logos\Test;

use Djunehor\Logos\Bible;
use Djunehor\Logos\Facades\BibleFacade;
use Illuminate\Support\Str;

class BibleTest extends TestCase
{
    public function testDefaultToEnglishKjv()
    {
        $bible = new Bible();
        $this->assertIsObject($bible);
    }

    public function testExceptionOnWrongLanguage()
    {
        $lang = 'yo';
        try {
            $bible = new Bible($lang);
        } catch (\Exception $exception) {
            $this->assertEquals("The language [$lang] doesn't exist", $exception->getMessage());
        }
    }

    public function testExceptionOnWrongVersion()
    {
        $lang = 'en';
        $version = 'amp';
        try {
            $bible = new Bible($lang, $version);
        } catch (\Exception $exception) {
            $this->assertEquals("The bible version [$version] for language [$lang] doesn't exist", $exception->getMessage());
        }
    }

    public function testExceptionOnNoIndex()
    {
        $lang = Str::random(2);
        mkdir(__DIR__.'/../bibles/'.$lang);
        try {
            $bible = new Bible($lang);
        } catch (\Exception $exception) {
            $this->assertEquals("Index of available books not found for [$lang]", $exception->getMessage());
        }
        rmdir(__DIR__.'/../bibles/'.$lang);
    }

    public function testGetBook()
    {
        $bible = new Bible();
        $bible->book('Genesis');

        $this->assertNotNull($bible->getBook());
    }

    public function testGetChapter()
    {
        $bible = new Bible();
        $bible->book('Exodus');
        $bible->chapter(3);

        $this->assertNotNull($bible->getChapter());
    }

    public function testGetVerse()
    {
        $bible = new Bible();
        $bible->book('Daniel');
        $bible->chapter(6);
        $bible->verse(11);

        $this->assertEquals('Then these men assembled, and found Daniel praying and making supplication before his God.', $bible->getVerse());
    }

    public function testGet()
    {
        $bible = new Bible();

        $this->assertEquals('For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.', $bible->get('John 3:16'));
    }

    public function testFacade()
    {
        $this->assertEquals('For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.', BibleFacade::get('John 3:16'));
    }

    public function testHelper()
    {
        $this->assertEquals('For God so loved the world, that he gave his only begotten Son, that whosoever believeth in him should not perish, but have everlasting life.', bible('John 3:16'));
    }
}
