<?php

namespace App\Entity;

use App\Repository\ShoppingCartRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Product;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=ShoppingCartRepository::class)
 */
class ShoppingCart {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Product")
     * @ORM\JoinTable(
     *      name="shopping_cart_products",
     *      joinColumns={@ORM\JoinColumn(
     *          name="product_id",
     *          referencedColumnName="id"
     *          )
     *      },
     *      inverseJoinColumns={@ORM\JoinColumn(
     *          name="shopping_cart_id",
     *          referencedColumnName="id"
     *          )
     *      },
     *  )
     */
    private $products;

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function getProducts() {
        return $this->products;
    }

    public function addProducts(Product $product) {
        if ($this->products->contains($product)) {
            return;
        }

        $this->products->add($product);
    }

    public function setProducts(array $products) {
        $this->products = $products;
    }
}
