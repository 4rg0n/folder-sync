<?php
/**
 * Abstrakte Collection
 *
 * @todo Translate to english
 * 
 * @package OST\Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

abstract class AbstractCollection implements \Iterator, CollectionInterface
{
    /**
     * Enthält einen Array mit allen Elementen der Collection
     *
     * @var array $items
     */
    protected $items = array();


    /**
     * Enthält einen Array mit allen Keys der Collection
     *
     * @var array $keys
     */
    protected $keys = array();


    /**
     * Enthält einen Array aus den Key und Index Beziehungen
     *
     * @var array $indexMap
     */
    protected $indexMap = array();


    /**
     * Enthält die Anzahl der Elemente der Collection
     *
     * @var int $length
     */
    protected $length = 0;


    /**
     * Der Pointer Wert, der für den Iterator benutzt wird
     *
     * @var int $pointer;
     */
    protected $pointer = 0;


    /**
     * Constructor
     *
     * @param array $array - Elemente, die der Collection hinzugefügt werden
     */
    public function __construct(Array $array = array())
    {
        $this->addAll($array);
    }


    /**
     * Gibt dem Iterator das derzeitige Element zurück.
     *
     * @see \Iterator
     *
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->pointer];
    }


    /**
     * Gibt den Iterator den derzeitigen Schlüssel zurück.
     *
     * @see \Iterator::key()
     *
     * @return string|int
     */
    public function key()
    {
        return $this->keys[$this->pointer];
    }


    /**
     * Setzt den Pointer eine Position weiter.
     *
     * @see \Iterator::next()
     */
    public function next()
    {
        ++$this->pointer;
    }


    /**
     * Resettet den Pointer
     *
     * @see \Iterator::rewind()
     */
    public function rewind()
    {
        $this->pointer = 0;
    }


    /**
     * Überprüft, ob ein Schlüssel an der Stelle des Pointers existiert.
     *
     * @see \Iterator::valid()
     *
     * @return boolean
     */
    public function valid()
    {
        return isset($this->keys[$this->pointer]);
    }


    /**
     * Fügt ein Element der Collection hinzu.
     *
     * @todo Bessere Variante finden Elemente ohne Schlüssel hinzuzufügen (SplStack Klasse?)
     *
     * @param string|int $key - der Schlüssel des Elements
     * @param mixed $item (otional) - das Element
     * @throws \Exception
     * @return mixed - das hinzugefügt Element
     */
    public function add($key, $item = null)
    {
        if (null === $item) {
            $item = $key;
            $key = uniqid(); //Drity...
        }

        //Existiert der Schlüssel schon?
        if ($this->hasKey($key)) {
            throw new \Exception(sprintf('Es existiert bereits ein Element mit dem Schlüssel "%s".', $key));
        }

        $index = $this->length;

        $this->keys[] = $key;
        $this->items[] = $item;
        $this->indexMap[$key] = $index;

        $this->length++;

        return $item;
    }


    /**
     * Ersetzt ein Element mit dem übergeben Schlüssel durch das neue Element.
     * Wenn kein Element mit dem Schlüssel existiert, wird es der Collection hinzugefügt.
     *
     * @param string|int $key - der Schlüssel des Elements
     * @param mixed $item - das neue Element
     * @return  \OST\Collection\AbstractCollection
     */
    public function replace($key, $item)
    {
        //Existiert der Schlüssel schon?
        if (false === $this->hasKey($key)) {

            //Hinzufügen
            $this->add($key, $item);
        }

        $index = $this->indexOfKey($key);
        $this->items[$index] = $item;

        return $this;
    }


    /**
     * Ersetzt ein Element in der Collection.
     *
     * @see \OST\Collection\AbstractCollection::replace()
     *
     * @param string|int $key - der Schlüssel des Elements
     * @param mixed $item - das neue Element
     * @return  \OST\Collection\AbstractCollection
     */
    public function set($key, $item)
    {
        return $this->replace($key, $item);
    }


    /**
     * Gibt anhand des übergebenen Keys das Element zurück.
     * Wenn kein Element gefunden wurde, wird null zurück gegeben.
     *
     * @param string|int $key - der Schlüssel des Elements
     * @return Mixed|void
     */
    public function get($key)
    {
        $index = $this->indexOfKey($key);

        $item = null;

        if (null !== $index) {
            $item = $this->items[$index];
        }

        return $item;
    }


    /**
     * Gibt ein Element an der übergebenen Stelle wieder.
     * Wenn der Index nicht existiert wird null zurück gegeben.
     *
     * @param int $index - die Position in der Collection
     * @return mixed|void
     */
    public function getAt($index)
    {
        $item = null;

        if (array_key_exists($index, $this->items)) {
            $item = $this->items[$index];
        }

        return $item;
    }


    /**
     * Gibt true zurück, wenn der übergebene Schlüssel ind er Collection existiert.
     * Ansonsten wird false zurück gegeben.
     *
     * @param string|int $key - der Schlüssel nach dem gesucht werden soll
     * @return Boolean
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->indexMap);
    }


    /**
     * Fügt alle Elemente aus dem übergebenen Array zur Collection hinzu
     *
     * @param array $array
     * @return  \OST\Collection\AbstractCollection
     */
    public function addAll(Array $array)
    {
        foreach($array as $key => $item) {
            $this->add($key, $item);
        }

        return $this;
    }


    /**
     * Gibt die Länge der Collection zurück.
     *
     * @return int - die Anzahl der Elemente in der Collection
     */
    public function count()
    {
        return $this->length;
    }


    /**
     * Entfernt anhand des übergebenen Schlüssel ein Element aus der Collection.
     * Es wird false zurück gegeben, wenn der übergebene Schlüssel nicht existiert
     * und das Element somit nicht gelöscht werden kann.
     *
     * @param string|int $key - der Schlüssel des Elements das entfernt werden soll
     * @return \OST\Collection\AbstractCollection|boolean
     */
    public function remove($key)
    {
        //Existiert der Schlüssel in der Collection?
        if (false === $this->hasKey($key)) {
            return false;
        }

        $index = $this->indexOfKey($key);

        unset($this->indexMap[$key]);

        /*
        unset($this->items[$index]);
        unset($this->keys[$index]);

        $this->items = array_values($this->items);
        $this->keys = array_values($this->keys);
        */

        array_splice($this->items, $index, $index);
        array_splice($this->keys, $index, $index);

        $this->length--;

        return $this;
    }


    /**
     * Löscht alle Elemente aus der Collection.
     *
     * @return \OST\Collection\AbstractCollection
     */
    public function clear()
    {
        $this->items = array();
        $this->keys = array();
        $this->indexMap = array();
        $this->length = 0;

        return $this;
    }


    /**
     * Verpackt alle Elemente der Collection in ein assoziatives Array und gibt dies zurück.
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();

        foreach($this->indexMap as $key => $index) {
            $array[$key] = $this->items[$index];
        }

        return $array;
    }


    /**
     * Gibt das erste Element der Collection zurück.
     *
     * @return mixed - erstes Element der Collection
     */
    public function first()
    {
        return $this->items[0];
    }


    /**
     * Gibt das letzte Element der Collection zurück
     *
     * @return mixed - letzte Element der Collection
     */
    public function last()
    {
        return $this->items[$this->count() - 1];
    }


    /**
     * Gibt alle Elemente der Collection zurück.
     *
     * @return array - Array mit allen Elementen der Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Gibt ein Array mit allen Schlüsseln aus der Collection zurück.
     *
     * @return array - Array mit allen Keys (Schlüsseln) aus der Collection
     */
    public function getKeys()
    {
        return $this->keys;
    }


    /**
     * Gibt den Index des übergebenen Schlüssel zurück.
     * Wenn der Schlüssel nicht existiert, wird null zurück gegeben.
     *
     * @param string|int $key - der zu suchende Schlüssel
     * @return int|void - der Index (Position) des Schlüssels in der Collection
     */
    public function indexOfKey($key)
    {
        $index = null;

        if ($this->hasKey($key)) {
            $index = $this->indexMap[$key];
        }

        return $index;
    }



    /**
     * Überprüft, ob die Collection leer ist.
     *
     * @return boolean - true wenn leer ansonsten false
     */
    public function isEmpty()
    {
        $empty = true;

        if ($this->count() > 0) {
            $empty = false;
        }

        return $empty;
    }
}


