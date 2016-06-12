<?php

namespace classes;

class UnregisteredUser extends User
{
    protected $passwordConfirm;
    
    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    /**
     * @param $post
     * @return UnregisteredUser
     */
    public static function buildFromPost($post)
    {
        $self = new self();
        
        foreach ($post as $key => $value) {
            $self->$key = $value;
        }
        return $self;
    }
    
    public function Validate()
    {
        if ($this->getPassword() == $this->getPasswordConfirm() && !(DataBase::getInstance()->getConnection()->query("SELECT COUNT(*) AS count FROM users WHERE login = '{$this->getLogin()}' OR email = '{$this->getEmail()}'")->fetch_object()->count)) {
            return true;
        }
        else{
            return false;
        }
    }

    public function Registration()
    {
        if ($stmt = DataBase::getInstance()->getConnection()->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)")) {
            $password = password_hash ($this->getPassword(), PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $this->getLogin(), $this->getEmail(), $password);
            if (!$stmt->execute()) {
                die('Insert error');
            }
        }
    }
}