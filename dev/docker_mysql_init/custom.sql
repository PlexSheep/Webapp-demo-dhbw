--
-- CUSTOM ADDED, NOT BY PHPMYADMIN
--

-- Add the user, that is used by the webapp
CREATE USER 'recipie_service'@'%' IDENTIFIED BY "example";
-- Grant it all privileges (change this for production FIXME)
GRANT ALL PRIVILEGES ON `Recepie\_Service`.* TO 'recipie_service'@'%';

