<?php

namespace App\Entity;

use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputRepository::class)]
class Input
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $input = '';

    #[ORM\Column(type: 'string', length: 255)]
    private $transform = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getTransform(): ?string
    {
        return $this->transform;
    }

    public function setTransform(string $transform): self
    {
        $this->transform = $transform;

        return $this;
    }
}
