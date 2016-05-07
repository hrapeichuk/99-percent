<?php

namespace classes;

class Response
{
    protected $question;
    
    protected $answers = [];

    /**
     * Response constructor.
     * @param array $answers
     * @param Question $question
     */
    public function __construct(array $answers, Question $question)
    {
        $this->question = $question;
        $this->answers = $answers;
    }

    /**
     * @param array $post
     * @param Question $question
     * @return Response
     */
    public static function constructFromPost(array $post, Question $question)
    {
        $answers = [];
        for ($i = 1; $i <= 5; $i++) {
            $answers[] = array_key_exists('tag_' . $i, $post) ? $post['tag_' . $i] : '';
        }
        
        return new self($answers, $question);
    }

    /**
     * @return bool
     */
    public function isValid() {
        foreach ($this->answers as $answer) {
            if (!$this->checkAnswer($answer)) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * 
     * 
     * @param $answer
     * @return bool
     */
    public function checkAnswer($answer)
    {
        return !empty($answer) && in_array(trim(mb_strtolower($answer)), array_map('mb_strtolower', $this->question->getTags()));
    }
}