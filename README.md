##MFW 1.2 - Mathison Framework 1.2
###Framework Solution for Rapid Development

*Under Development*

This solution was inspired by a multitude of different online solutions to a variety of development choke points. MFW1.2 Aims to ease the process of overcoming a wide variety of those choke points.

###Bash Installation

1. Read each instruction first before starting.
2. Run the below bash Script.
3. Upload a Laravel 5 database.php file to config folder with DB credentials before running PHP Artisan Migrate.
4. Visit www.YOURURL.com/admin/super/
5. Build out the backend of your site!

*Bash*
```
/> git clone https://github.com/Divinityfound/Mathison-Framework-1.2.git websiteFolderName/
/> cd websiteFolderName/
websiteFolderName> composer update
websiteFolderName> chmod -R 755 .
websiteFolderName> php artisan migrate
```

###Site Set Up

1. You'll be able to create your secured admin backend now. Add credentials now. Admin is the default username if you don't use an email.
2. Set up your cron jobs to target www.YOURURL.com/admin/super/crons/run at the frequency you desire. [Feature coming]