<?php
/**
 * Ordner Collection
 *
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

use OST\Model\Folder as FolderModel;

class Folder extends AbstractCollection
{
    /**
     * Stellt sicher, dass das Item ein Ordner ist
     *
     * @see OST\Collection\AbstractCollection::add();
     *
     * @param int|string $key
     * @param \OST\Model\Folder $item
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function add($key, $item)
    {
        if (false === $item instanceof FolderModel) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter item muss eine Instanz von "%s" sein. "%s" gegeben',
                'OST\Model\Folder',
                gettype($item)
            ));
        }

        return parent::add($key, $item);
    }
}