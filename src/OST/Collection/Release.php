<?php
/**
 * Release Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

use OST\Model\Release as ReleaseModel;

class Release extends AbstractCollection
{
    /**
     * Ensure that given item is an File Model
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param \OST\Model\Release $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key,  $item = null)
    {
        if (false === $item instanceof ReleaseModel) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item must be an instance of "%s"',
                'OST\Model\Release'
            ));
        }

        return parent::add($key, $item);
    }
}