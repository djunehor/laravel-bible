<?php

namespace Djunehor\Logos;

class Bible
{
    private $lang;
    private $version;
    private $bible;
    private $book;
    private $chapter;
    private $verse;

    public function __construct($lang = 'en', $version = 'kjv')
    {
        $this->lang($lang);
        $this->version($version);

        $this->lang = $lang;
        $this->version = $version;
    }

    public function lang($lang)
    {
        if (! file_exists(__DIR__.'/../bibles/'.$lang)) {
            throw new \Exception("The language [$lang] doesn't exist");
        }
        if (! file_exists(__DIR__.'/../bibles/'.$lang.'/Books.json')) {
            throw new \Exception("Index of available books not found for [$lang]");
        }
        $this->lang = $lang;
    }

    public function version($version)
    {
        if (! file_exists(__DIR__.'/../bibles/'.$this->lang.'/'.$version)) {
            throw new \Exception("The bible version [$version] for language [$this->lang] doesn't exist");
        }
        $this->version = $version;
    }

    public function book($bookName)
    {
        $this->bible = json_decode(file_get_contents(__DIR__."/../bibles/$this->lang/Books.json"), true);
        $this->book = ucfirst($bookName);

        return $this;
    }

    public function chapter(int $chapterNumber)
    {
        $this->chapter = $chapterNumber - 1;

        return $this;
    }

    public function verse(int $verseNumber)
    {
        $this->verse = $verseNumber - 1;

        return $this;
    }

    public function getBook()
    {
        $bookPath = __DIR__."/../bibles/$this->lang/$this->version/$this->book.json";
        if (file_exists($bookPath)) {
            return json_decode(file_get_contents($bookPath), true);
        }
    }

    public function getChapter()
    {
        if ($book = $this->getBook()) {
            return $book['chapters'][$this->chapter] ?? null;
        }
    }

    public function getVerse()
    {
        if ($chapter = $this->getChapter()) {
            if ($verse = $chapter['verses'][$this->verse]) {
                return $verse['text'] ?? null;
            }
        }
    }

    public function get($string)
    {
        $explodeSpace = explode(' ', $string);
        $this->book($explodeSpace[0]);
        $explodeColumn = explode(':', $explodeSpace[1]);
        $this->chapter($explodeColumn[0]);
        $this->verse($explodeColumn[1]);

        return $this->getVerse();
    }
}
