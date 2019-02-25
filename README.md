# InsuranceCRM REST API demo Application

This is a simple REST API application that is part of the backend of InsuranceCRM Demo Application. 
[ Here is a frontend part of this app.](https://github.com/piotrwojewoda/insurance-crm-react)
## Live demo API:
[ -> click here <-](http://pw85.pl/insuranceapi/public/index.php/api)

##Installation guide:

1. clone repository.
2. run `docker-compose up -d`
3. go into builded container `docker exec -it #container_id bash`
4. run `php bin/console make:migration`
5. run `php bin/console doctrine:migrations:migrate`
6. load fixtures `php bin/console doctrine:fixtures:load`
7. Generate public and private keys and put them to `config/jwt/private.pem` & `config/jwt/public.pem`.

##Screens:

![image](https://user-images.githubusercontent.com/39909775/53327663-8b2c1180-38e8-11e9-8141-04955e9a4467.png)

![image](https://user-images.githubusercontent.com/39909775/53327749-b878bf80-38e8-11e9-90d9-397ca818d774.png)
