Hauptfunktion
=============

Es gibt ein Hauptarchiv, das als Grundlage f�r das Syncen gedacht ist.
Es k�nnen mehrere Hauptarchive angelegt werden.
Diese sind auch als Release- oder Medienarchive zu verstehen.

Anlegen des Hauptarchives
-------------------------

*   Drag & Drop liest Ordner ein
*   Liste wird generiert - Umschaltm�glichkeiten zwischen Release / Filmname
*   API Einbindung von XREL (bzw IMDB bei nicht gefundenem Release)
*   2 Ansichten: Listenansicht / Galerieansicht
*   Watchlist von IMDb im Hauptarchiv integrieren (-> [Link](https://gist.github.com/matrixagent/1209367))
*   SQLite als Datenbank

Interface
---------

*   Anzeige Hauptarchiv - beinhaltet die Listen und Galerieansicht (Standart: Galerieansicht)
    *    Ohne Releasenamen! Bei Klick auf einen Film werden unterschiedliche Releases angeboten
	     Wenn nur ein Release angezeigt wird, wird dieser Schritt �bersprungen.
	*    Filterm�glichkeiten (siehe PreDB)
	*    Autofocus in der Suche (Standart: Titelsuche)
*   Anzeige Film Detailseite
    *    Release Name
	*    Cover Image
	*    IMDb Rating
	*    Regisseur
	*    Jahr
	*    Schauspieler
*   Sync-Verlauf - beinhaltet alle �nderungen in einer Art Changelog

Synchronisation
---------------

*   Es kann zwischen mehreren Hauptarchiven (HA) gew�hlt werden
*   Sync funktioniert so:
    Hauptarchiv < Syncoption > Quelle/Ziel
*   Syncoptionen k�nnen sein:
    *    Quelle in das HA mergen (d.h. HA hat am Ende alles)
	*    HA nach Quelle mergen (d.h. Quelle hat am Ende alles)
	*    sync beide Seiten (d.h. Beide haben Alles)
*   Sync Vorschau
*   Sync Geschwindigkeit anzeigen