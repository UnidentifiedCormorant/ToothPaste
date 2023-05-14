<?php

namespace App\Classes;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class WordsWrapper
{
    protected $text;
    protected $keyWords;

    public function __construct($text)
    {
        $this->text = $text;
    }

    protected function getEngWords()
    {
        preg_match_all("((?:[a-zA-Z]+[-']?)*[a-zA-Z]+)", $this->text, $this->keyWords);
    }

    protected function getRuWords()
    {
        preg_match_all('/([а-я]+)/ui', $this->text, $this->keyWords);
    }

    protected function replaceWord($keyWord)
    {
        $this->text = Str::replace($keyWord, $this->wrapWord($keyWord), $this->text);
    }

    protected function wrapWord($word)
    {
        $word = Str::start($word, '<font color="red">');
        $word = Str::finish($word, '</font>');

        return $word;
    }

    public function wrap(string $language)
    {
        if ($language == 'ru')
        {
            $this->getRuWords();
        }
        else
        {
            $this->getEngWords();
        }

        if (!empty($this->keyWords[0]))
        {
            foreach ($this->keyWords[0] as $keyWord)
            {
                $this->replaceWord($keyWord);
            }
        }

        return $this->text;
    }
}
