<?php

namespace classes;

class ImageQuestion extends Question
{
    public function display()
    {
        return "<img src='" . $this->source . "'/>";
    }
}