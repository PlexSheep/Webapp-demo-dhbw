# Webapp-demo-dhbw
Demo project for DHBW Mannheim Webapplication Lectures.

The purpose of this README is to help you with deploying and using the app.

# Deployment
- You'll need a webserver and a database server (perferably MariaDB)
- configure the `rezepti_config.ini file to your needs
- you might want to forbid the access to `rezepti_config.ini` with your Webserver.
    On NGINX:
    ```
    location /rezepti_config.ini {
        return 403;
    }
    ```

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

# Documentation
The full Documentation for our project has been compiled into 
[Documentation.pdf](Documentation.pdf).
If you want to look at the full project, we have released it [here](https://github.com/PlexSheep/Webapp-demo-dhbw)
