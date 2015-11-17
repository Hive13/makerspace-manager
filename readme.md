## MakerSpace Manager

This is a laravel application to manage a makerspace.

## Dependencies

The application runs on Apache2, MySQL, and NodeJS. 

## Installation 

Pull this repository to a directory.
Run the following commands:

* composer installer
* npm install
* cp .env.example .env
* EDIT THE NEW .ENV FILE WITH YOUR DATABASE INFO/OTHER STUFF. 
* gulp
* php artisan key:generate
* php artisan migrate
* php artisan db:seed --class=ConstantsSeeder

By default in most apache installations youll also need to enable mod_rewrite in your config.

Visit the directory in your browser /public