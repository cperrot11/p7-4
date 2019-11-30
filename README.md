# Bilemo API
Version 1.0.0

This project is a REST API to allow Bilemo partners to display their mobile phones catalog.
This API was built with **Symfony 4.3.5**.
It's the 7th [OpenClassRooms](https://openclassrooms.com/) PHP/Symfony Developer project.

<a href="https://codeclimate.com/github/cperrot11/p7-4/maintainability"><img src="https://api.codeclimate.com/v1/badges/324468d5e21e8896c519/maintainability" /></a>

---

As you can see there are symfony standard folders + diagrams :
- [diagrams folder](https://github.com/cperrot11/p7-4/tree/master/diagrams) where you will find project related usefull diagrams.
- [api folder](https://github.com/cperrot11/p7-4/tree/master/src) where you will find REST API source code.

## API instructions
Below the instructions to use Bilemo REST API from your application.

### Prerequisites
- PHP >=7.1.3
- MySQL
- [Composer](https://getcomposer.org/) to install Symfony 4.6 and project dependencies

### Dependencies
This project uses essentially :
- [API-platform](https://github.com/api-platform/api-platform) to simplify REST API creation
- [JWT AuthentificationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) to manage Bilemo partners token Authentication


Those dependencies are included in composer.json.

### Installation
1. Clone this repository on your local machine by using this command line in your folder `git clone https://github.com/cperrot11/p7-4.git`.
2. In project folder open a new terminal window and execute command line `composer install`.
3. Edit `DATABASE_URL` parameters in `\.env` with your database value.
4. Execute command line `php bin/console doctrine:database:create`. Create the database in your environment.
5. Execute command line `php bin/console doctrine:migrations:migrate`. Create the tble on your databse 
4. Execute command line `php bin/console bilemo:fixtures:load`. This command will load some fixtures.
5. Your project is now up to date!

### Authentication to access API
This API is restricted to Bilemo partners. When a Bilemo admin adds your application as a new partner, your credentials are sent to you.

#### Use BILEMO demo (postman)
Now that you're a Bilemo partner, you need to get an access token to access API methods.

Set `Content-Type: application/json` in your request headers and do a POST request on `/login_check` with those JSON parameters in request body:

```
{
	"username": "Phone House",
	"password": "123456"
}
```


You will get an `access_token` and you can now access API endpoints by setting those parameters in each request headers:
```
Content-Type: application/json
Authorization: Bearer {YourAccessToken}
```

Your access token expires after 1 hour. To get a new access token POST a new request headers on `/login_check`.

Now you'ready to enjoy! Refer to documentation to use API endpoints according to your needs.

### Documentation
This API project is as documented as possible, so you can find:
- a full documentation of API methods can be found [here](https://127.0.0.1:8000/docs)..
- and some [diagrams](https://github.com/cperrot11/p7-4/tree/master/diagrams)


