# Calculation service

## Installation
### Environment variables
It's important to setup directory for external files.
Add to `.env` next parameter:
```dotenv
SHARED_DIRECTORY='shared'
```

### Build docker-compose
This command will build containers for you

    make build

### Run docker-compose
This command will initiate and run docker-compose services for you

    make run

## Run Calculation command
### Calculation history file
Put your file (`input.txt` or another one similar) to the directory you set up for external files (by default `shared`)
(examle was set there by default)

### Running service
1. Start service with command

        make run
    or if it was built and dependencies was installed you can use command

        make up
2. Run shell using command

        make shell
3. Use your command

   ```shell
    php app.php input.txt
   ```
   if your transaction history file has different name use it

### Calculation result configuration
By default, we use Commission calculation with round up for 2 symbols precision
If you need more symbols of precision you can change it in ` #app/config/services.yaml`
   ```yaml
   App\Service\CommissionCalculationServiceInterface: '@App\Service\CommissionCalculationRoundUpService'
   ```
to another one service
   ```yaml
   App\Service\CommissionCalculationServiceInterface: '@App\Service\CommissionCalculationService'
   ```

## Tests
### All tests
This command will run all tests

    make tests
