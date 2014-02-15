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
use OST\Sanitizer\ReleaseName;

class Release extends AbstractModel
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
     * Contains the sanitized name of the folder
     *
     * @var string
     */
    private $sanitizedName;


    /**
     * Constructor
     *
     * @param SplFileInfo $info
     */
    public function __construct(SplFileInfo $info)
    {
        $this->info = $info;
        $this->key = $info->getPath() . '/' . $info->getFilename();

        //Sanitizes the Filename
        //Todo Hydrator / Strategies >.<
        $sanitizer = ReleaseName::getInstance();
        $saniName = $sanitizer->sanitize($info->getFilename());

        $this->setSanitizedName($saniName);
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

    /**
     * Returns the sanitized name
     *
     * @return string
     */
    public function getSanitizedNamed()
    {
        return $this->sanitizedName;
    }

    /**
     * Sets the sanitized name
     *
     * @param $name
     */
    public function setSanitizedName($name)
    {
        $this->sanitizedName = $name;
    }
}
