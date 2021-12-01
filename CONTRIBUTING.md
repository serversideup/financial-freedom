# Welcome and thanks!
Thanks for checking out Financial Freedom! There are a lot of things in motion right now, and we plan to make it easier for contributions soon.

# Submitting a PR
Since everything is so new, please explain your intentions on our community before going through the effort of making a PR: https://community.serversideup.net/t/requesting-features-for-financial-freedom/460

# Running locally in your development
We encourage you to replicate this on your machine and tinker around with it. Here is how you can run it.

**Important notes:**
* We use [Docker Overrides](https://docs.docker.com/compose/extends/), which allow us to apply overrides on a per environment basis
* The commands to run docker are obnoxious, but we are working on releasing an internal tool (called [Spin](https://github.com/serversideup/spin)) that shortens this up 😁 (it's a work in progress right now)

### Ensure you have the latest version of Docker
You can download that here: https://www.docker.com/products/docker-desktop

### Clone the repo
Pull the repo down into and folder of your choice.

### Copy over the example env
```sh
cp .env.example .env
```

### Install composer dependencies
```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml run --no-deps --rm -e "S6_LOGGING=1" php composer install
```

### Install Node dependencies
This might take a while because how slow mounted volumes are with Docker
```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml run --no-deps --rm node yarn install
```

### Generate a new Laravel app key
```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml run --no-deps --rm -e "S6_LOGGING=1" php php artisan key:generate
```

### Bring your containers up
```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml up
```

### Seed your database
Run the command below in a **new terminal window while your containers are running**.

**Important note:** On your first provision, you must wait for the database to provision the user. Look at the Docker compose output for "financial-freedom-mariadb-1". It will say something like `[Entrypoint]: Creating user financial_freedom_database_user`
```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec php php artisan migrate
```

### Configure hosts file
The server expects a URL of "https://financial-freedom.dev.test". For that to resolve, you can set your local machine hosts file.

```
127.0.0.1 financial-freedom.dev.test
```

### If you're making changes to the front-end
We use InertiaJS as a frontend javascript library. If you are making changes, you will need to run the "dev" process within Node.

```sh
docker compose -f docker-compose.yml -f docker-compose.dev.yml run --no-deps --rm node yarn dev
```

### Accessing the application
Once you have the application online, you can register an account at https://financial-freedom.dev.test/register