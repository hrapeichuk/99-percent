<?php

namespace classes;

class VideoQuestion extends Question
{
    public function display()
    {
        return "<iframe width=\"500\" height=\"500\" src='" . $this->source . "'></iframe>";
    }
}