<?php
namespace App\Html;

class Form {

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function input(string $key, string $name) : ?string
    {

        $type = 'text';
        if($key === 'password') $type = 'password';
        if($key === 'email') $type = 'email';
        $value = '';
        if(isset($this->data[$key])){
            $value = $this->data[$key];
        }
        return <<<HTML
            <input type="{$type}" id="field-{$key}" class="input-auth" name="{$key}" placeholder="Entrez votre {$name}" required value="{$value}">
HTML;
    }

    public function select(string $key) : ?string
    {
        $countries = ['Algerie', 'Benin', 'Cameroun', 'Congo' , "Cote d'ivoire", 'Gabon', 'Senegal', 'Togo'];
        $options = [];
        foreach($countries as $k => $country){
            $options[] = "<option value=\"{$country}\">{$country}</option>";
        }
        $options = implode('', $options);
        return <<<HTML
            <div id="select-section">
            <select id="select-{$key}" class="select-auth" name="{$key}">{$options}</select>
            </div>
HTML;
    }

    public function checkbox(string $key,  $checked = false) : ?string
    {
        return <<<HTML
            <input type="checkbox" id="{$key}" name="{$key}">
            <label for="{$key}">Voir le mot de passe</label>
HTML;
    }
}