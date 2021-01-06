<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="products")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected string $name;

    /**
     * @var string
     * @ORM\Column(name="price", type="decimal", length=10, scale=6, nullable=false)
     */
    protected string $price;

    /**
     * @var int
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    protected int $count;

    /**
     * @var bool
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    protected bool $active;

    /**
     * @var array
     * @ORM\Column(name="attributes", type="simple_array", nullable=false)
     */
    protected array $attributes;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->active = false;
        $this->attributes = [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Product
     */
    public function setPrice(string $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Product
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Product
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return Product
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }
}
