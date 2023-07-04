<?php

namespace User;

class Contact
{
    public string $immagine_contatto;
    public string $nome = "";
    public string $cognome = "";
    public string $societa = "";
    public string $qualifica = "";
    public string $email = "";
    public string $numero = "";
    public string $compleanno = "";

    public function __construct($immagine_contatto = "", $nome = "", $cognome = "", $societa = "", $qualifica = "", $email = "", $numero = "", $compleanno = "")
    {
        $this->immagine_contatto = $immagine_contatto;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->societa = $societa;
        $this->qualifica = $qualifica;
        $this->email = $email;
        $this->numero = $numero;
        $this->compleanno = $compleanno;
    }

    public function getContactFields(): array
    {
        return array_keys(get_object_vars($this));
    }
}