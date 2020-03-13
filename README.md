# Users API

This app is an unsecured microservice meant to be hosted on a private network accessible 
to only trusted systems. For example, an OAuth application would be accessible to the public
and make API requests to this Users API over a private network.

## Quickstart for Lando Users

Tooling for `bin/console` and `make` have been added to the Lando config. Since there's no Symfony recipe, it's
based on Laravel so you have access to `composer` as well.

Run the following commmands to get started with Lando:

```bash
# Build and start the app.
lando start

# Wipe db and install the migration.
lando make db-init

## Seed the database.
lando make db-seed
```

Now you can navigate to the OpenAPI docs: 
- REST API: http://users-api.lndo.site/api
- GraphQL API: http://users-api.lndo.site:8000/api/graphql

Tooling:

```bash
# Run bin/console commands: i.e. bin/console cache:clear
lando console cache:clear

# Run make commands (There are common application commands defined in the Makefile)
lando make cc
```

## Testing

There are 4 make commands for testing which still need to be wired up:

```bash
# Run unit tests
make testu

# Run functional tests
make testf

# Run unit tests, followed by functional tests
make test

# Run coverage report
make coverage
```

## The Makefile

This repo uses a Makefile for a few reasons:
- It is a reference for commands common to the project
- Provides a less verbose way to run the commands
- Provides a standard way to execute common functionality across different frameworks & languages

`make` is installed by default on OSX and most Linux distros.
 
As an example, clearing cache commands are different between Symfony, Laravel, Drupal, Wordpress, etc.  You can abstract
these commands, or combination of commands, into one that is consistent between environments. i.e. `make cc`

Another example would be running tests. Standardizing on `make` allows you to use something like `make testu` to run
unit tests whether you are using PHP, JavaScript, Go, Python, or any framework or combination of languages and frameworks.

When using Lando, I typically setup the Makefile so it can be used with or without Lando. This allows developers not
using Lando to use them and provides the advantage of being able to run them on servers where Lando isn't being used.
