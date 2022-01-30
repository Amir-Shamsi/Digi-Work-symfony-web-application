# Digi Work (Symfony Web Application)

a ticket system for sending technicians and answering people's technical questions.


### Installation
1. clone the Reop
  ```sh
  git clone https://github.com/Amir-Shamsi/Digi-Work-symfony-web-application.git
  ```
2. Set the database in your `.env`
  ```sh
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
  ``` 
3. Creating the database tables/schema
  ```sh
  php bin/console doctrine:schema:update --force
  ```
4. Run Server
  ```sh
  symfony serve
  ```
5. Open `127.0.0.1:8000` in your browser
