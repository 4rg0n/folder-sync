<?php
/**
 * Collection Interface
 * 
 * @package Collection
 * @author Dominic Rönicke <argonthechecker@gmail.com>
 * @version $Id: $
 */

namespace OST\Collection;

interface CollectionInterface
{
    /**
     * Gibt einen Eintrag aus der Collection mit dem übergebnen Key zurück
     *
     * @param string|int $key - der Schlüssel des Elements welches zurück gegeben werden soll
     * @return mixed
     */
    public function get($key);


    /**
     * Fügt ein Element mit dem übergebenen Key zur Collection hinzu
     *
     * @param string|int $key - der Schlüssel des Elements
     * @param mixed $item - das Element
     * @return mixed - das hinzugefügte Item
     */
    public function add($key, $item);


    /**
     * Entfernt ein Element anhand des übergebenen Schlüssels aus der Collection
     *
     * @param string|int $key - Schlüssel des zu entfernenden Elements
     * @return $this
     */
    public function remove($key);


    /**
     * Ersetzt ein Element mit dem übergebenen Schlüssel in der Collection, durch das neue übergene Element
     *
     * @param string|int $key - der Schlüssel des zu ersetzenden Elements
     * @param mixed $item - das neue Element
     * @return $this
     */
    public function replace($key, $item);


    /**
     * Gibt die Anzahl der Elemente in der Collection zurück
     *
     * @return int - Anzahl der Elemente der Collection
     */
    public function count();


    /**
     * Löscht alle Elemente aus der Collection
     *
     * @return $this
     */
    public function clear();


    /**
     * Wandelt die Collection in ein Array und gibt dieses zurück
     *
     * @return array
     */
    public function toArray();
}


