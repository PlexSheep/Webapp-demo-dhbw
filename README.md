# Webapp-demo-dhbw
Demo project for DHBW Mannheim Webapplication Lectures.

We want to make a recipe sharing platform.

> Eine Seite Für Kochrezepte von verschiedenen Ländern all around the globe.

# Technology Stack
- PHP for Server Backend (requirement)
- Bootstrap 5.3 (requirement)
- Nginx
- docker/podman for deployment
- MariaDB (requirement)
- JQuery (requirement)
- JQueryUI (requirement)
- Tagify
- HTML5 (requirement)
- CSS (requirement)
- JS (requirement)

# Requirements (German)
- [X] Dokumentation 
- [X] Referenzdokument
- [X] Product-Backlog
- [X] Verzeichnis- und Datenstruktur

## Funktions Requirements
### Vorgaben:
- [X] Sessionverwaltung
- [X] Login-Logout; automatisches Logout nach bestimmter Zeit
- [X] Admin-Bereich mit Useraccount-Verwaltung
- [X] Passwort-Verwaltung (Im Admin-Bereich)
- [X] Rechte-Verwaltung (Adminrechte-Userrechte)
    - Es gibt nur einen Admin, dieser hat die ID 1
- [X] Dateneingaben client- und serverseitig prüfen (RegExp)
    - in `create.php`
    - Implementiert in common.php (`test_for_bad_chars`, `test_for_bad_chars_array`)
- [X] Datensatzmanipulation in SQL-Server (speichern; auslesen/ausgeben; bearbeiten; löschen)
- [X] Konfigurationsdaten via Konfigurationsdatei einlesen
    - php.ini
    - soll vom webserver geschützt werden. Da Sie ihren eigenen Webserver verwenden möchten,
      können wir ihnen dafür keine Konfiguration mitschicken.

      Für nginx: (see [our nginx config](nginx/default.conf))
      ```
      ...

      location /rezepti_config.ini {
          return 403;
      }

      ...
      ```
- [X] Einbindung von jQuery und jQuery UI
    - tag felder in `create.php`
- [X] Dynamische laden/nachladen mit Hilfe von AJAX
    - im Admin Panel (suche nach user email)
- [X] Meldungsfenster und Userbestätigungen mit jQuery und jQuery UI
    - im Admin Panel
- [X] Datenexport via JSON
    - im Admin Panel
- [X] Dynamische Menüstruktur mit responsive Webdesign
    - überall auf der website durch Bootstrap 5.3
## Eigene Features:
- [X] Tags, Kategorien und Ursprungsländer
- [X] Suche nach Rezepten

# Default Credentials
| User             | Password |
|------------------|----------|
| admin@adm.de     | admin    |
| WILLIAMS@test.de | test     |
| JONES@test.de    | test     |
| BROWN@test.de    | test     |
| MOORE@test.de    | test     |
| TAYLOR@test.de   | test     |

and many more

# Documentation
A verbose [Documentation](abgabe/Documentation.pdf) in german has been written.
