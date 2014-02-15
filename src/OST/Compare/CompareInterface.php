<?php
/**
 * Compare Interface
 * 
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Compare;

use OST\Collection\CollectionInterface;

interface CompareInterface
{
    public function compare(CollectionInterface $collectionLeft, CollectionInterface $collectionRight);
}


