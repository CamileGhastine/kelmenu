<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Pantry::class, mappedBy="ingredient", orphanRemoval=true)
     */
    private $pantries;

    public function __construct()
    {
        $this->pantries = new ArrayCollection();
    }

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

    /**
     * @return Collection|Pantry[]
     */
    public function getPantries(): Collection
    {
        return $this->pantries;
    }

    public function addPantry(Pantry $pantry): self
    {
        if (!$this->pantries->contains($pantry)) {
            $this->pantries[] = $pantry;
            $pantry->setIngredient($this);
        }

        return $this;
    }

    public function removePantry(Pantry $pantry): self
    {
        if ($this->pantries->removeElement($pantry)) {
            // set the owning side to null (unless already changed)
            if ($pantry->getIngredient() === $this) {
                $pantry->setIngredient(null);
            }
        }

        return $this;
    }
}
