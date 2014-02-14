<?php
/**
 * File Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

use OST\Model\File as FileModel;

class File extends AbstractCollection
{
    /**
     * Ensure that given item is an File Model
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param \OST\Model\File $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key,  $item = null)
    {
        if (false === $item instanceof FileModel) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item must be an instance of "%s"',
                'OST\Model\File'
            ));
        }

        return parent::add($key, $item);
    }
}