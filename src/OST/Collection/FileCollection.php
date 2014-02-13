<?php
/**
 * Ordner Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

use OST\Model\ModelInterface;

class FileCollection extends AbstractCollection
{
    /**
     * Stellt sicher, dass das Item das korrekte Interface implementiert
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param OST\Model\ModelInterface $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key, $item)
    {
        if (false === $item instanceof ModelInterface) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item muss eine "%s" implementieren. "%s" gegeben',
                get_class(ModelInterface),
                gettype($item)
            ));
        }

        return parent::add($key, $item);
    }
}