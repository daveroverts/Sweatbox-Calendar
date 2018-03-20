# Sweatbox Calendar [![Build Status](https://travis-ci.org/daveroverts/Sweatbox-Calendar.svg?branch=dev)](https://travis-ci.org/daveroverts/Sweatbox-Calendar)

## About this project
This project has been created using Laravel. The purpose was for me to learn Laravel, so I can use it for later projects.

## Features

- Create/Edit/Remove students.
- Create/Edit/Remove sessions.
- Easy way to retrieve stats of student.
- Session types can be edited to what's needed within your vACC

## Installing
These steps already assume you have a working PHP server to work with
 1. Clone the repo
 1. Copy ``.env.example`` to ``.env``, and change data where needed. Only DB credentials are required.
    - At some point, emails will also be used to send reminders to mentors/students before a session (if they want).
 1. Run ``php artisan key:generate``
 1. Run ``composer install``
 1. Open ``database/migrations/2018_03_01_102943_create_session_types.php``, and add/edit/remove session types if needed.
    - At some point, a page will be created where you can edit the session types.
 1. Run ``php artisan migrate``
 1. Run ``php artisan serve``
 1. Navigate to ``http://loclahost:8000``
 
 Default Login: ``Email: admin@sweatbox.io`` | ``Password: admin`` (can be changed after first login)
