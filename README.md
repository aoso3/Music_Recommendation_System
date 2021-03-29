<h1>Music Recommendation System</h1>
This project presents an automated sound clustering method depending on machine learning and music information retrieval (MIR).
Allowing people to search their favorite song or music and listen to the most similar ones throw a graph of songs, where each node represent a song.

## WebApp Installation 

Clone the repository

    git clone https://github.com/aoso3/Music_Recommendation_System.git

Switch to the repo folder

    cd Music_Recommendation_System

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Refer to the link to install ElasticSearch 

https://github.com/elastic/windows-installers/blob/master/README.md

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000



## Clustering Installation 

Refer to the link to install SparkLib

https://www.knowledgehut.com/blog/big-data/how-to-install-apache-spark-on-windows

### Insert the resulting clustering data from the clustering app to ElasticSearch database.
