<?php

namespace App\Controller;

use App\Controller\NormalizingController;
use Doctrine\ORM\EntityManager;

abstract class NormalizingOrmController extends NormalizingController {
    public function get_entity_manager(): EntityManager {
        return $this->getDoctrine()->getManager();
    }

    public function get_or_404(
        $repository,
        $pk
    ) {
        $item = $repository->find($pk);

        if (!$item) {
            throw $this->createNotFoundException(
                "No item found for pk {$pk}"
            );
        }

        return $item;
    }
}
