# Shopping-Cart-API

Run locally:  
``composer install --no-dev``  
``php bin/console doctrine:database:create``  
``php bin/console doctrine:migrations:migrate``  
``symfony server:start``  

## Routes

### Products

BASE_URL = /products  

GET / : List  
GET /{pk} : Retrieve  
POST / : Create  
PATCH /{pk} : Partial Update  
PUT /{pk} : Update
DELETE /{pk} : Delete  

### Shopping Cart

BASE_URL = /shopping  

GET /{pk} : Retrieve  
POST / : Create  
PATCH /{pk} : Partial Update  
PUT /{pk} : Update  
DELETE /{pk} : Delete  
# cart_api
