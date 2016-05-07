<?php

namespace classes;

class Game
{
    protected $level = 1;
    
    /** @var ImageQuestion */
    protected $question;

    protected $data = [
        1 => [
            'type'  => 'image',
            'source' => 'https://only-apartments.storage.googleapis.com/web/imgs/city/London_Small.jpg',
            'tags' => ['Англия', 'Лондон', 'Биг Бэн', 'Темза', 'Тауэрский мост',
                'Объединённый Джек', 'королева', 'парламент', 'красный автобус', 'телефонная будка',
                'чай', 'гвардейцы', 'колесо обозрения'
            ]
        ],
        2 => [
            'type'  => 'image',
            'source' => 'https://d2ykdu8745rm9t.cloudfront.net/cover/i/009/649/798/tumblr_nvvzquvieu1ufrciro1_500-6495.gif?rect=0,0,500,500&q=98&fm=jpg&fit=max',
            'tags' => ['зима', 'лес', 'дерево', 'ветка', 'природа',
                'снег', 'холод', 'мороз', 'снежинка', 'иней'
            ]
        ],
    ];

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->level = isset($_SESSION['level']) ? $_SESSION['level'] : 1;

        if (!$this->isEnd()) {
            $this->question = Question::constructByType($this->data[$this->level]['type']);
            $this->question->setSource($this->data[$this->level]['source']);
            $this->question->setTags($this->data[$this->level]['tags']);
        }
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return ImageQuestion
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function goToNextLevel()
    {
        $_SESSION['level'] = $this->level + 1;
    }

    /**
     * 
     */
    public function reset()
    {
        unset($_SESSION['level']);
    }
    
    public function isEnd() {
        return $this->level > count($this->data);
    }
}