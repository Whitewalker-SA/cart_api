<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer as Normalizer;



abstract class NormalizingController extends AbstractController {
    public Normalizer $normalizer;

    public function __construct() {
        $this->normalizer = new Normalizer();
    }

    public function _normalize($object) {
        return $this->normalizer->normalize($object);
    }

    public function normalize($data) {
        if (is_array($data)) {
            array_map('self::_normalize', $data);
        } else {
            $data = $this->_normalize($data);
        }
        return $data;
    }
}
