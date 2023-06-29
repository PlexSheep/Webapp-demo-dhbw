# Webapp-demo-dhbw
Demo project for DHBW Mannheim Webapplication Lectures.

We want to make a recipe sharing platform.

# Technology Stack
- PHP for Server Backend (requirement)
- Bootstrap for CSS Framework (requirement, verhandelbar?)
- Nginx as Webserver
- docker/podman for deployment
- MariaDB (requirement)
- JQuery (requirement)
- JQueryUI (requirement)
- HTML5 (requirement)
- CSS (requirement)
- JS (requirement)

# Requirements
- [ ] Dokumentation 
- [ ] Referenzdokument
- [X] Product-Backlog
- [X] Verzeichnis- und Datenstruktur

# Funktions Requirements
## Vorgaben:
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
      Für nginx:
      ```
      ...

      location /php.ini {
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

Und viele mehr

# Backlog
| Title                                        | Status |
|----------------------------------------------|--------|
| Documentation                                | [X]    |
| Merge because stupid                         | [X]    |
| Frontend domme                               | [X]    |
| Frontend                                     | [X]    |
| fix konto page                               | [X]    |
| input validation in create page              | [X]    |
| Usercontent                                  | [X]    |
| Frontend                                     | [X]    |
| checkboxes                                   | [X]    |
| Merge main                                   | [X]    |
| creation works now                           | [X]    |
| Merge main into frontend                     | [X]    |
| J query                                      | [X]    |
| Use local j-query instead of js-deliver CDN? | [X]    |
| AJAX                                         | [X]    |
| Node stuff                                   | [X]    |
| Security                                     | [X]    |
| fix xss in search                            | [X]    |
| Benutzerverwaltung                           | [X]    |
| templatisation                               | [X]    |
| Search                                       | [X]    |
| Security                                     | [X]    |
| Database                                     | [X]    |
| Html templates                               | [X]    |
| Create ingredigent                           | [X]    |
| synchronized header and footer               | [X]    |
| logout                                       | [X]    |
| Docker bei windows für Domme                 | [X]    |
| Early Documentation Document for class       | [X]    |
| Zutaten / Tags in der Datenbank              | [X]    |
