<?php
class Helper_Mail{
    protected $a;
    protected $sujet;
    protected $message;

    public function to($a)
    {
        $this->a = $a;
        return $this;
    }

    public function sujet($sujet)
    {
        $this->sujet = $sujet;
        return $this;
    }

    public function content($message)
    {
        $this->message = $message;
        return $this;
    }

    public function send(){
        return mail($this->a, $this->sujet, $this->message,'Content-type: text/html');
    }
}