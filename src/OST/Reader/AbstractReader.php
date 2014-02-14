<?php
/**
 * Abstrakte Reader
 * 
 * @package OST\Reader
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Reader;

use Symfony\Component\Finder\Finder;
use OST\Collection\CollectionInterface;

abstract class AbstractReader implements ReaderInterface
{
    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;


    /**
     * @var \OST\Collection\CollectionInterface
     */
    protected $collection;


    /**
     * Constructor
     *
     * Fuck Dependency Injection!
     *
     * @param \OST\Collection\CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->finder = new Finder();
        $this->collection = $collection;
    }


    /**
     * Returns the instance of Symfony Finder class
     *
     * @return Finder
     */
    public function getFinder()
    {
        return $this->finder;
    }


    /**
     * Returns the Collection
     *
     * @return CollectionInterface
     */
    public function getCollection()
    {
        return $this->collection;
    }


    /**
     *
     * @param string $path - path to directory
     */
    abstract public function read($path);
}


