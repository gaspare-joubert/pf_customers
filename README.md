# Podfather DevOps Tech Test
This is a toy application which allows viewing, creating, and editing customers.
To simplify deployment, it does not use a database and instead stores data directly on the filesystem.

## Running the application locally:
To bring up the docker compose stack, cd to the project directory and run:
- docker compose up -d

The application should then be accessible at http://localhost/.

Try creating and editing some customers.

## Your Task

### Part 1
Currently, customers have a name, an address, a city, and a country. The users of our toy app would also like to be able to store an email address against each customer, to make contacting customers easier.

Modify the application so that customers can have an email stored against them. This should include:
- email displayed on customer list at /
- email field present in create/edit form
- email saved correctly when using create/edit forms

Hint: to see your changes in your browser either run "docker compose build fpm && docker compose up -d" after each change, or uncomment the bind mounts in the docker-compose.yml file.

### Part 2
Deploy your modified version of the application from Part 1 to a cloud hosting provider of your choice, so that the application is publicly accessible.

Confirm that customers can be created, edited, and viewed in the same way as when the application is run locally.

Submit the URL where your version of the application can be accessed. Also include a short description of how you deployed the application (for example: which service(s) did you use).

Consider what further work would be required if you were deploying a real production service. This will be discussed in the interview stage.



