<?php
/**
 * File reader class
 *
 * @package OST\Reader
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Reader;

use OST\Model\File as FileModel;

class File extends AbstractReader
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
        foreach ($finder->in($path) as $file)
        {
            $fileModel = new FileModel($file);

            $collection->add($fileModel->getKey(), $fileModel);
        }

        return $collection;
    }
} 