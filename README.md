# Install

```shell
cd path/to/to-do-api
docker-compose up --build (first time)
```

The api should be available at http://localhost:8080

Create a todo_lists.json file inside var folder. Go inside container and run:

```shell
docker exec -ti to-do-api_api_1 bash
chown -R www-data:www-data var/todo_lists.json
```

If your IDE does not render the openapi documentation, please copy and paste the contents at https://editor.swagger.io/
