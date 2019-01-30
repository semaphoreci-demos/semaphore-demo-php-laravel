# semaphore-php-example

Simple Laravel web application with Semaphore pipeline example.

## Prerequisites

To setup the project locally, your local environment needs to be setup. For a full list of requirements, 
check out [Laravel Documentation](https://laravel.com/docs/5.7#server-requirements).
We recommend setting up using Vagrant and Homestead, as it is a turn key solution supported on all major operating systems. 
A Dockerized setup is also a viable option. 

## Project Setup

Once the local environment is setup to be able to run Laravel applications, pull in the local repository and run the following
set of commands.

```
git clone git@github.com:savamarkovic/semaphore-php-example.git
cp .env.example .env // and enter your DB details in the newly created .env
composer install
php artisan key:generate
php artisan migrate

```
That will set up the application on your local environment. 

## Semaphore Pipeline

Once you push your fork of the repository to Github, you can add it to Semaphore as well. Make sure you have connected Semaphore
to your Github account.
```
curl https://storage.googleapis.com/sem-cli-releases/get.sh | bash // install Semaphore CLI to local env
sem connect <semaphore-organization-link> <semaphore-id> // found in Semaphore Dashboard
cd <project directory>
sem init
```
After that, each push to the repository will trigger a pipeline to be ran on Semaphore.

## Example Pipeline
![pipeline](https://i.imgur.com/mg1bcsQ.png)
The pipeline is defined inside `.semaphore/semaphore.yml` file.
The example pipeline contains 6 blocks:
 - Install Dependencies 
    -  installs and caches all composer and npm dependencies
 - Run Code Analysis 
    - Runs PHP Mess Detector which as an example is installed as a composer dependency
    - Runs PHP Code Sniffer which as an example is installed as a composer dependency
    - Runs PHP Copy Detector which is called via cURL from the .phar package available online
 - Run Unit Tests
    - Runs PHPUnit Unit Tests
 - Run Browser Tests
    - Runs browser tests through Laravel Dusk. 
 - Run Security Tests
    - Runs Sensiolabs security checker pulled in via cURL
