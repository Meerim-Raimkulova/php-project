<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $kod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $oblast;

    /**
     * @ORM\Column(type="integer")
     */
    private $kalky;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getKod(): ?int
    {
        return $this->kod;
    }

    public function setKod(int $kod): self
    {
        $this->kod = $kod;

        return $this;
    }

    public function getOblast(): ?string
    {
        return $this->oblast;
    }

    public function setOblast(string $oblast): self
    {
        $this->oblast = $oblast;

        return $this;
    }

    public function getKalky(): ?int
    {
        return $this->kalky;
    }

    public function setKalky(int $kalky): self
    {
        $this->kalky = $kalky;

        return $this;
    }
}
