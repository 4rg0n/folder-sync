<?php
/**
 * Datei Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

use OST\Model\ModelInterfacel;

class File extends AbstractCollection
{
    /**
     * Stellt sicher, dass das Item ein Model ist
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param \OST\Model\ModelInterfacel $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key, $item = null)
    {
        if (false === $item instanceof ModelInterfacel) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item must be an instance of "%s". "%s" given',
                'OST\Model\ModelInterfacel',
                gettype($item)
            ));
        }

        return parent::add($key, $item);
    }
}