<?php
namespace App\Model;

class Caracteristiques {

    private $id;
    private $processeur;
    private $ram;
    private $graphics;
    private $screen;
    private $other;
    private $dd;
    private $battery;
    private $installed_sys;

    /**
     * Get the value of id
     */ 
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of processeur
     */ 
    public function getProcesseur() : ?string
    {
        return $this->processeur;
    }

    /**
     * Set the value of processeur
     *
     * @return  self
     */ 
    public function setProcesseur(string $processeur) : self
    {
        $this->processeur = $processeur;

        return $this;
    }

    /**
     * Get the value of ram
     */ 
    public function getRam() : ?string
    {
        return $this->ram;
    }

    /**
     * Set the value of ram
     *
     * @return  self
     */ 
    public function setRam(string $ram) : self
    {
        $this->ram = $ram;

        return $this;
    }

    /**
     * Get the value of graphics
     */ 
    public function getGraphics() : ?string
    {
        return $this->graphics;
    }

    /**
     * Set the value of graphics
     *
     * @return  self
     */ 
    public function setGraphics(string $graphics) : self
    {
        $this->graphics = $graphics;

        return $this;
    }

    /**
     * Get the value of screen
     */ 
    public function getScreen() : ?string
    {
        return $this->screen;
    }

    /**
     * Set the value of screen
     *
     * @return  self
     */ 
    public function setScreen(string $screen) : self
    {
        $this->screen = $screen;

        return $this;
    }

    /**
     * Get the value of other
     */ 
    public function getOther() : ?string
    {
        return $this->other;
    }

    /**
     * Set the value of other
     *
     * @return  self
     */ 
    public function setOther(string $other) : self
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get the value of dd
     */ 
    public function getDd() : ?string
    {
        return $this->dd;
    }

    /**
     * Set the value of dd
     *
     * @return  self
     */ 
    public function setDd(string $dd) : self
    {
        $this->dd = $dd;

        return $this;
    }

    /**
     * Get the value of battery
     */ 
    public function getBattery() : ?string
    {
        return $this->battery;
    }

    /**
     * Set the value of battery
     *
     * @return  self
     */ 
    public function setBattery(string $battery) : self
    {
        $this->battery = $battery;

        return $this;
    }

    /**
     * Get the value of installed_sys
     */ 
    public function getInstalled_sys() : ?string
    {
        return $this->installed_sys;
    }

    /**
     * Set the value of installed_sys
     *
     * @return  self
     */ 
    public function setInstalled_sys($installed_sys) : self
    {
        $this->installed_sys = $installed_sys;

        return $this;
    }
}