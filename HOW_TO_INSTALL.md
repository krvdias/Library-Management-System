# Library Management System

## How to install the system to your computer from repository

### 1. Go to your file location that you want to install this project (if it is localhost , goto xampp folder >> htdocs)
### 2. Open command promt
### 3. Type below camands one by one

#### i. git clone https://github.com/krvdias/Library-Management-System.git
#### ii. cd Library-Management-System
#### iii. composer install

### 4. Up your local host or host server
### 5. Create a database with preferd name
### 6. Open downloded project using code editor my option is vscode
### 7. Open terminal
### 8. Type below camand

#### i. cp .env.example .env

### 9. After that command system will create new file name called ".env"
### 10. Open the page 

#### Inside the page fill this section according to your database credintials

### DB_CONNECTION=mysql
### DB_HOST=127.0.0.1
### DB_PORT=3306
### DB_DATABASE=[enter your database name]
### DB_USERNAME=root
### DB_PASSWORD= 

### 11. Go back to terminal
### 12. Type below commands

#### i. php artisan key:generate
#### ii. php artisan migrate
#### iii. npm install
#### iv. npm run dev

### 13. Get new terminal
### 14. Type below commands

#### i. php artisan db:seed
#### 11. php artisan serve

### 15. Go to provided link 
### 16. Enter login credintials

 #### user name : lib@example.com
 #### password : 12345678

 # Thank You
