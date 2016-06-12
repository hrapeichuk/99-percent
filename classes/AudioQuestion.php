<?php

namespace classes;


class AudioQuestion extends Question
{
    public function display()
    {
        return "<img src='sound.jpg' style='display: block; margin: 0px auto; margin-bottom: 15px;'/> <audio src='" . $this->source . "' controls></audio>";
    }
}