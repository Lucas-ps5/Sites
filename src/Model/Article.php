<?php
namespace App\Model;

class Article {

    private $id;
    private $name;
    private $category;
    private $marque;
    private $path;
    private $slug;
    private $description;
    private $prix;
    
    
    public function getId() : ?int
    {
        return $this->id;
    }


    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }
    

    public function getName() : ?string
    {
        return $this->name;
    }

     
    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    
    public function getCategory() : ?string
    {
        return $this->category;
    }

     
    public function setCategory(string $category) : self
    {
        $this->category = $category;

        return $this;
    }

   
    public function getMarque() : ?string
    {
        return $this->marque;
    }

   
    public function setMarque(string $marque) : self
    {
        $this->marque = $marque;

        return $this;
    }

     
    public function getPath() : ?string
    {
        return $this->path;
    }

   
    public function setPath(string $path) : self
    {
        $this->path = $path;

        return $this;
    }

    
    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }
 
    public function setDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix() : ?float
    {
        return $this->prix;
    }

     
    public function setPrix(float $prix) : self
    {
        $this->prix = $prix;

        return $this;
    }
}