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
            'source' => 'http://s8.favim.com/orig/140404/bigben-england-london-photography-Favim.com-1607609.jpg',
            'tags' => ['Англия', 'Лондон', 'Биг Бэн', 'Темза', 'Тауэрский мост',
                'Объединённый Джек', 'королева', 'парламент', 'красный автобус', 'телефонная будка',
                'чай', 'гвардейцы', 'колесо обозрения'
            ]
        ],
        2 => [
            'type'  => 'video',
            'source' => 'http://www.youtube.com/embed/wjLeWjfQJ98?autoplay=1',
            'tags' => ['десерт', 'пирожное', 'крем', 'бисквит', 'украшение',
                'кулинария', 'выпечка', 'розочки', 'кухня', 'сладость', 'кекс', 'вкусно'
            ]
        ],
        3 => [
            'type'  => 'audio',
            'source' => 'rain.mp3',
            'tags' => ['дождь', 'зонт', 'зонтик', 'лужи', 'тучи',
                'гроза', 'ливень', 'гром', 'плащ', 'влажность', 'осадки'
            ]
        ],
        4 => [
            'type'  => 'image',
            'source' => 'http://www.animacity.ru/sites/default/files/imagecache/blog-big/blog/28139/arNhkeaGcVU.jpg',
            'tags' => ['зима', 'лес', 'дерево', 'ветка', 'природа',
                'снег', 'холод', 'мороз', 'снежинка', 'иней', 'дорога', 'ель'
            ]
        ],
        5 => [
            'type'  => 'video',
            'source' => 'http://www.youtube.com/embed/OG2eGVt6v2o?autoplay=1',
            'tags' => ['море', 'солнце', 'пляж', 'песок', 'океан',
                'отдых', 'лето', 'волны', 'загар', 'ракушки', 'жара', 'пальма'
            ]
        ]
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
     * @return mixed
     */
    public function getType()
    {
        return $this->data['type'];
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

    public function reset()
    {
        unset($_SESSION['level']);
    }
    
    public function isEnd()
    {
        return $this->level > count($this->data);
    }
}