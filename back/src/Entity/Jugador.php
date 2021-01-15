<?php

namespace App\Entity;

use App\Repository\JugadorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JugadorRepository::class)
 */
class Jugador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $ultimoPuntaje;

    /**
     * @ORM\Column(type="integer")
     */
    private $mejorPuntaje;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getUltimoPuntaje(): ?int
    {
        return $this->ultimoPuntaje;
    }

    public function setUltimoPuntaje(int $ultimoPuntaje): self
    {
        $this->ultimoPuntaje = $ultimoPuntaje;

        return $this;
    }

    public function getMejorPuntaje(): ?int
    {
        return $this->mejorPuntaje;
    }

    public function setMejorPuntaje(int $mejorPuntaje): self
    {
        $this->mejorPuntaje = $mejorPuntaje;

        return $this;
    }
}
