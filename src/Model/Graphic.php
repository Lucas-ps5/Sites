<?php
namespace App\Model;

class Graphic {

    private $id;
    private $nom;
    private $marque;
    private $path;
    private $slug;
    private $mem_d;
    private $prix;
    private $description;

   
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }
 
    public function getNom() : ?string
    {
        return $this->nom;
    }
 
    public function setNom($nom) : self
    {
        $this->nom = $nom;

        return $this;
    }
 
    public function getMarque() : ?string
    {
        return $this->marque;
    }

    public function setMarque($marque) : self
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

    public function getMem_d() : ?int
    {
        return $this->mem_d;
    }

    public function setMem_d(int $mem_d) : self
    {
        $this->mem_d = $mem_d;

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

    public function getDescription() : ?string
    {
        return $this->description;
    }
 
    public function setDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }
}