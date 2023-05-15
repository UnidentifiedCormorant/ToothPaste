<?php

namespace App\Classes;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Подсвечивает слова выбранного для пасты языка красным цветом
 */
class WordsWrapper
{
    protected string $text;
    protected array $keyWords;

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Вытаскивает английские слова в $keyWords
     *
     * @return void
     */
    protected function getEngWords()
    {
        preg_match_all("((?:[a-zA-Z]+[-']?)*[a-zA-Z]+)", $this->text, $this->keyWords);
    }

    /**
     * Вытаскивает русские слова в $keyWords
     *
     * @return void
     */
    protected function getRuWords()
    {
        preg_match_all('/([а-я]+)/ui', $this->text, $this->keyWords);
    }

    /**
     * Заменяет ключевое слово на <font color="red">ключевое слово</font>
     *
     * @param $keyWord
     * @return void
     */
    protected function replaceWord($keyWord)
    {
        $this->text = Str::replace($keyWord, $this->wrapWord($keyWord), $this->text);
    }

    /**
     * Оборачивает ключевое слово в теги для подсвечивания текста красным цветом
     *
     * @param $word
     * @return string
     */
    protected function wrapWord($word) : string
    {
        $word = Str::start($word, '<font color="red">');
        $word = Str::finish($word, '</font>');

        return $word;
    }

    /**
     * Ключевая функция, подсвечвает слова из выбранного для пасты языка
     *
     * @param string $language
     * @return string
     */
    public function wrap(string $language) : string
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
