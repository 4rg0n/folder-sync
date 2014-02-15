<?php
/**
 * Release reader class
 *
 * @package OST\Reader
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Reader;

use OST\Model\Release as ReleaseModel;

class Release extends AbstractReader
{
    /**
     * Reads all files located into the given path
     *
     * @param string $path
     * @return \OST\Collection\File
     */
    public function read($path)
    {
        $finder = $this->getFinder();
        $collection = $this->getCollection();

        //read files and folders
        foreach ($finder->directories()->in($path) as $file)
        {
            $releaseModel = new ReleaseModel($file);

            $collection->add($releaseModel->getKey(), $releaseModel);
        }

        return $collection;
    }
} 