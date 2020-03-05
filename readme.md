I3 Software

This is a PHP Laravel Project.

Make sure to clone this project in a project directory.
- Install or update Homebrew: brew update
- Install PHP7: brew install homebrew/php/php70
- Install Valet with Composer via composer global require laravel/valet. Make sure the ~/.composer/vendor/bin directory is in your system's "PATH".
- Run the valet install command. This will configure and install Valet and DnsMasq, and register Valet's daemon to launch when your system starts.
    - install valet by running: valet install
    
Database

- If you need a database, try MariaDB by running "brew install mariadb" on your command line. You can connect to the database at 127.0.0.1 using the root username and an empty string for the password

- Inside the project directory run: valet start
                                  : php artisan migrate:fresh
                                  : php artisan db:seed
                                                               
- Access the web-application by serving http://i3project.test/


Should you run into any problems regarding valet check out the following link: https://laravel.com/docs/5.2/valet
Else contact me on smallcarlo@gmail.com

Thanks again for the opportunity
