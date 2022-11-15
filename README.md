# Website Factory

[![GitHub contributors](https://img.shields.io/github/contributors/code4romania/website-factory.svg?style=for-the-badge)](https://github.com/code4romania/website-factory/graphs/contributors) [![GitHub last commit](https://img.shields.io/github/last-commit/code4romania/website-factory.svg?style=for-the-badge)](https://github.com/code4romania/website-factory/commits/master) [![License: MPL 2.0](https://img.shields.io/badge/license-MPL%202.0-brightgreen.svg?style=for-the-badge)](https://opensource.org/licenses/MPL-2.0)

Most NGOs don’t have a simple and easy to use solution for people without technical skills or a solution adapted to their specific needs. Website Factory: NGO allows any NGO to easily build a website that provides the main types of content that organizations need, solutions for reporting, fundraising and communication with target audiences, etc.

Website Factory: NGO is a unique solution, developed as a unit, which can be reused by any organization. Thus, each association will have the opportunity to build a website containing essential and relevant information for good communication with donors and the general public. Made of simple, accessible modules that facilitate the publication of information, code of conduct, official documents, with annual report templates and integrated with online donation collection modules, this solution supports pro-bono the entire sector and help NGOs communicate more effectively, increasing their fundraising capacity.

[Contributing](#contributing) | [Built with](#built-with) | [Development](#development) | [Deployment](#deployment) | [Feedback](#feedback) | [License](#license) | [About Commit Global](#about-commit-global)

## Contributing

This project is built by an amazing team of civic technologists and amazing volunteers and you can be one of them! Here's a list of ways in [which you can contribute to this project](https://github.com/code4romania/.github/blob/main/CONTRIBUTING.md).

## Built with
-   Laravel
-   Tailwind CSS
-   Inertia.js
-   Vue.js
-   Alpine.js

### Requirements
-   PHP 8.1+
-   Nginx
-   PostgreSQL 14+

## Development
This project uses Laravel Sail, Laravel's default Docker development environment.

After running the [initial setup](#initial-setup), run this command to start up the environment:
```sh
./vendor/bin/sail up -d
```

and then this command to rebuild the css / js assets on change:

```sh
./vendor/bin/sail npm run watch
```

### Initial setup

```sh
# 1. Install composer dependencies
docker run --rm -v ${PWD}:/app -w /app composer:latest composer install --ignore-platform-reqs --no-scripts --no-interaction --prefer-dist --optimize-autoloader

# 2. Copy the environment variables file
cp .env.example .env

# 3. Start the application
./vendor/bin/sail up -d

# 4. Install npm dependencies
./vendor/bin/sail npm ci

# 5. Build the frontend
./vendor/bin/sail npm run dev

# 6. Generate the app secret key
./vendor/bin/sail artisan key:generate

# 7. Migrate and seed the database
./vendor/bin/sail artisan migrate:fresh --seed
```

For more information on Laravel Sail, check out the [official documentation](https://laravel.com/docs/9.x/sail).

## Deployment

The fastest way to deploy Website Factory is by using our first-party [Docker image](https://hub.docker.com/r/code4romania/website-factory).

### Prerequisites

#### Generate an application key

Before deploying Website Factory, make sure you generate a valid application key. If you are not sure what an application key is, you can read more about it here: [`APP_KEY` And You](https://tighten.com/blog/app-key-and-you/) blog post on Tighten's website.

To generate an application key, you can run the following command in your terminal.

```sh
docker run --rm -it code4romania/website-factory php artisan key:generate --show
```

The generated application key will look like this:

```
base64:yEtz1eacKMwq0iVT5BUjMMvcn4OAD7QpCgz1yDoXroE=
```

### Running the image

Download the [example `docker-compose.yml`](docs/examples/docker-compose.yml) and configure the environment variables. Here's where you use the `APP_KEY` generated earlier. After you're done, save the file and run it with:

```sh
docker-compose up -d
```

You should now be able to access your instance admin area by visiting `<your-ip>:8080/admin` and logging in with the `ADMIN_EMAIL` and `ADMIN_PASSWORD` you specified in the configuration.


## Deployment on AWS / Microsoft Azure with terraform

We maintain two separate terraform repositories for Website Factory. To learn more about the infrastructure we provisioned for Website Factory on these cloud providers, please check their respective repositories:
- https://github.com/code4romania/terraform-aws-website-factory
- https://github.com/code4romania/terraform-azure-website-factory


## Feedback

-   Request a new feature on GitHub.
-   Vote for popular feature requests.
-   File a bug in GitHub Issues.
-   Email us with other feedback contact@commitglobal.org

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Commit Global

The team behind Commit Global has a robust and celebrated track record in the tech for social good field since 2015. We have built the fastest growing organization in the space, Code for Romania and set it up as a model of good practices on how to design and build technology that helps at scale. Our tools have served governments, UN agencies and large and small CSOs during crisis and peace time. Most recently we have built, deployed and maintained a first of its kind humanitarian ecosystem in support of refugees fleeing from Ukraine, ensuring their safe and uninterrupted access to information, healthcare and services, while equipping NGOs with the tools they need to be more effective.

All throughout our activity we have been one of the champions of cooperation and co-creation in the the civic tech field, constantly investing efforts and resources in working with and supporting the work of similar organizations around the world. As part of these efforts we created, curated and hosted the largest civic tech strategic event in history, the 2018 Code for All Global Summit: a 4 days offline event where hundreds of delegates from all continents exchanged ideas and digital solutions for the benefit of humanity.

Find more details on https://www.commitglobal.org/en
