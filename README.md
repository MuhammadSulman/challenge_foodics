## Installation and configuration

There are the following required.

- composer 2.
- php 8.1
- mysql 8

installed laravel sail for virtual env, we can use it as well, env variables have been set.

## Implementations

### Seeders
- UsersTableSeeder: To add the Marchant
- ProductsTablesSeeder: To add the product e.g burger
- RecipesTableSeeder: To make the relations between product and ingredients along with the required amount for a single unit cooking/making etc.
- IngredientsTableSeeder: To seed the ingredients that are provided in the requirement like beef, cheese, and onion with their amount and unit as well.
  
### Models
There are the following models.

- Product
- Ingredient
- Order
- Recipe (pivot): to attach the or make the relation between product and ingredient, like which product can have which ingredients with required amount to formulate a single unit like burger (150g beef, 30g cheese, 20g onion).
- Marchant: to send the notification(email) when ingredient is left 50% or below.

### Form Request
- OrderRequest: To validate the incoming request from the customer.

### Controller
There is a single controller
- OrderController: contain store method, which accept order and dump into the database and then update the stock accordingly.

### Test Cases
There are the followin Tests
- TestStore: assert the store API that exist in the order controller.
- testStockUpdatedCorrectly: assert the stock either its updating correctly.

