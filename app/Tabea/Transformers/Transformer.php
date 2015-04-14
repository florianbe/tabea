<?php namespace Tabea\Transformers;
/**
 * Created by PhpStorm.
 * User: lankin
 * Date: 12/04/15
 * Time: 20:33
 */

    abstract class Transformer {

        public function transformCollection(array $items)
        {
            return array_map([$this, 'transform'], $items);
        }

        public abstract function transform ($item);
    }

