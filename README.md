# Users API

This app is an unsecured microservice meant to be hosted on a private network accessible 
to only trusted systems. For example, an OAuth application would be accessible to the public
and make API requests to this Users API over a private network.

Update the `.env` file with desired configurations and reference the `Makefile` for setup commands.


## Lando

Run the following commmands to get started with Lando:

```bash
# Build and start the app.
lando start

# Install the schema.
lando make db-init
```
