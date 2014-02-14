<?php
/**
 * File Model
 *
 * @package OST\Model
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Model;

use Symfony\Component\Finder\SplFileInfo;

class File extends AbstractModel
{
    /**
     * Contains the instance of SplFileInfo class
     *
     * @var \Symfony\Component\Finder\SplFileInfo
     */
    private $info;


    /**
     * Contains the key of the model
     * (path to the file with filename)
     *
     * @var string
     */
    private $key;


    /**
     * @param SplFileInfo $info
     */
    public function __construct(SplFileInfo $info)
    {
        $this->info = $info;
        $this->key = $info->getPath() . '/' . $info->getFilename();
    }


    /**
     * Returns the file info object
     *
     * @return SplFileInfo
     */
    public function getInfo()
    {
        return $this->info;
    }


    /**
     * Returns the key of the model
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
