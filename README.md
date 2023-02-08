# Install

```shell
cd path/to/to-do-api
docker-compose up --build (first time)
docker exec -ti to-do-api_api_1 bash
composer install
```

The api should be available at http://localhost:8080

If your IDE does not render the openapi documentation, please copy and paste the contents at https://editor.swagger.io/
