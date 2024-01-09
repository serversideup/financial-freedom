# Welcome and thanks!
Thanks for checking out Financial Freedom! There are a lot of things in motion right now, and we plan to make it easier for contributions soon.

# Submitting a PR
Since everything is so new, please explain your intentions on our community before going through the effort of making a PR: https://github.com/serversideup/financial-freedom/discussions/63

# Running locally in your development
We encourage you to replicate this on your machine and tinker around with it. Here is how you can run it.

**Important notes:**
* We user Docker to run our entire stack. No local services are required.
* Be sure if you have MAMP, XAMPP, or any other local services running, that you shut them down first. They will conflict with the ports we use.
* We use [Docker Overrides](https://docs.docker.com/compose/extends/), which allow us to apply overrides on a per environment basis
* We have a tool called [Spin](https://serversideup.net/open-source/spin/) which greatly improves the development experience
* `spin` is automatically installed via Composer for this project

### Ensure you have the latest version of Docker
You can download that here: https://www.docker.com/products/docker-desktop

### Suggested: Add `spin` as an alias
If you do not add `spin` as an alias, you will need to type this every time you fire up your development environment:

```sh
bash vendor/bin/spin
```

If you don't want to do that, you can [install `spin` on your system](https://serversideup.net/open-source/spin/), or add this alias:
```sh
alias spin='[ -f node_modules/.bin/spin ] && bash node_modules/.bin/spin || bash vendor/bin/spin'
```
Add the above line to your `~/.bash_profile` or `~/.zshrc` file. After saving the changes, `source` that file or simply close and re-open your terminal before continuing.

### Clone the repo
Pull the repo down into and folder of your choice.

### Copy over the example env
```sh
cp .env.example .env
```

### Install composer dependencies
Assuming you aliased `spin` as defined above, run the following commands. If you didn't, you will need to use `bash vendor/bin/spin` instead of `spin`.

```sh
spin run php composer install
```
### Install Node dependencies
This might take a while because how slow mounted volumes are with Docker
```sh
spin run node yarn install
```

### Generate a new Laravel app key
```sh
spin run php php artisan key:generate
```

### Bring your containers up
```sh
spin up
```

### Seed your database
Run the command below in a **new terminal window while your containers are running**.

**Important note:** On your first provision, you must wait for the database to provision the user. Look at the Docker compose output for "financial-freedom-mariadb-1". It will say something like `[Entrypoint]: Creating user financial_freedom_database_user`
```sh
spin exec php php artisan migrate
```

### Configure hosts file
The server expects a URL of "https://financialfreedom.dev.test". For that to resolve, you can set your local machine hosts file.

```
# For accessing the Financial Freedom locally
127.0.0.1 financialfreedom.dev.test

# For accessing Mailpit locally
127.0.0.1 mailpit.dev.test

# For using Vite in development
127.0.0.1 vite.dev.test
```

### If you're making changes to the front-end
We use InertiaJS as a frontend javascript library. If you are making changes, you will need to run the "dev" process within Node.

```sh
spin run node yarn dev
```

### Accessing the application
Once you have the application online, you can register an account at https://financialfreedom.dev.test/register