<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @var int
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    protected int $created;

    /**
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $this->created = time();
    }
}
