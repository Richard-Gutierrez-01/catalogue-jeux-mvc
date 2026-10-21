<?php
namespace App\Providers;

// Validateur de formulaires (API fluide) : chaque field() ouvre une chaîne de règles
class Validator {

    private $errors = array();
    private string $key;
    private string $value;
    private string $name;

    public function field(string $key, string $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    // -- règles --
    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key] = "$this->name est requis";
        }
        return $this;
    }

    public function min(int $length){
        if(strlen($this->value) < $length){
            $this->errors[$this->key] = "$this->name doit contenir au moins $length caractères";
        }
        return $this;
    }

    public function max(int $length){
        if(strlen($this->value) > $length){
            $this->errors[$this->key] = "$this->name doit contenir au maximum $length caractères";
        }
        return $this;
    }

    public function int(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_INT)){
            $this->errors[$this->key] = "$this->name doit être un nombre entier";
        }
        return $this;
    }

    public function float(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_FLOAT)){
            $this->errors[$this->key] = "$this->name doit être un nombre";
        }
        return $this;
    }
    // -- fin des règles --

    public function isSuccess(){
        return empty($this->errors);
    }

    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }
}
?>
