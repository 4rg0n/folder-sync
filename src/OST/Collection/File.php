<?php
/**
 * Datei Collection
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
     * Stellt sicher, dass das Item eine Datei ist
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param \OST\Model\File $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key, $item)
    {
        if (false === $item instanceof FileModel) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item muss eine Instanz von "%s" sein. "%s" gegeben',
                'OST\Model\File',
                gettype($item)
            ));
        }

        return parent::add($key, $item);
    }
}