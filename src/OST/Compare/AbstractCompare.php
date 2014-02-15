<?php
/**
 * Abstrakte Compare
 * 
 * @package OST\Compare
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Compare;

use OST\Collection\CollectionInterface;

abstract class AbstractCompare implements CompareInterface
{
    public function compare(CollectionInterface $collectionLeft, CollectionInterface $collectionRight)
    {

    }
}


