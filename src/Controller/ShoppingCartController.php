<?php

namespace App\Controller;

use App\Controller\NormalizingOrmController;
use App\Repository\ShoppingCartRepository;
use App\Entity\ShoppingCart;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shopping-carts", name="shopping_cart_")
 */
class ShoppingCartController extends NormalizingOrmController {
    public function get_product_repository(): ProductRepository {
        return $this->product_repository = $this
        ->get_entity_manager()
        ->getRepository(Product::class);
    }

    /**
     * @Route(
     *      "/{pk}",
     *      methods={"GET"},
     *      name="retrieve"
     * )
     */
    public function retrieve(
        string $pk,
        ShoppingCartRepository $repository
    ): Response {
        $item = $this->get_or_404($repository, $pk);

        return $this->json($item);
    }

    /**
     * @Route(
     *      "/",
     *      methods={"POST"},
     *      name="create"
     * )
     */
    public function create(Request $request): Response {
        $body = json_decode($request->getContent(), true);

        $item = new ShoppingCart();
        $products = $body["products"];
        foreach ($products as &$product) {
            $product = $this->get_or_404(
                $this->get_product_repository(),
                $product
            );
        }
        $item->setProducts($products);
        $this->get_entity_manager()->persist($item);
        $this->get_entity_manager()->flush();

        return $this->json(["id" => $item->getId()], 201);
    }

    /**
     * @Route(
     *      "/{pk}",
     *      methods={"PATCH"},
     *      name="partial_update"
     * )
     */
    public function partial_update(
        string $pk,
        Request $request,
        ShoppingCartRepository $repository
    ): Response {
        $body = json_decode($request->getContent(), true);

        $item = $this->get_or_404($repository, $pk);

        foreach ($body["products"] as $product_pk) {
            $product = $this->get_or_404(
                $this->get_product_repository(),
                $product_pk
            );
            $item->addProducts($product);
        }
        $this->get_entity_manager()->flush();

        return $this->json($item);
    }

    /**
     * @Route(
     *      "/{pk}",
     *      methods={"PUT"},
     *      name="update"
     * )
     */
    public function update(
        string $pk,
        Request $request,
        ShoppingCartRepository $repository
    ): Response {
        $body = json_decode($request->getContent(), true);
        $item = $this->get_or_404($repository, $pk);

        $products = $body["products"];
        foreach ($products as &$product) {
            $product = $this->get_or_404(
                $this->get_product_repository(),
                $product
            );
        }
        $item->setProducts($products);
        $this->get_entity_manager()->flush();

        return $this->json($item);
    }

    /**
     * @Route(
     *      "/{pk}",
     *      methods={"DELETE"},
     *      name="delete"
     * )
     */
    public function delete(
        string $pk,
        ShoppingCartRepository $repository
        ): Response {
        $item = $this->get_or_404($repository, $pk);
        $this->get_entity_manager()->remove($item);
        $this->get_entity_manager()->flush();

        return new Response();
    }
}
