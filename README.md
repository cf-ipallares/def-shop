**NOTES ABOUT APPLICATION DEPLOYMENT**

* scripts/def-shop-db.sql has the DB structure and contents to get started.
* In paramters.yml there is a property `url_prefix` to map the root of the url.
* PHP 7.2 used.

**CODE DESCRPITION** 
* Routes (quite self descriptive):

    'GET/login'                 - Show login form
    
    'POST/login'                - Validate login
    
    'GET/products'              - Show all products in the shop
    
    'GET/color/products'        - Show products filtered by color (not implemented)
    
    'POST/basket/add-product'   - Add a product to the basket (increment its quantity if it was already there)
    
    'GET/basket'                - Show the basket contents
    
    'GET/user/create'           - Shows the form to create a new user
    
    'POST/user/create'          - Creates a new user
    
    'GET/payment'               - Manages the payment of an order
    

* router.php takes care of mapping such urls to controller/action methods.
* Controller files have the entry point to every specific action.
* There is a basic Container to store data and Services and allow simple dependency injection.
* Repository files take care of accesing the DB and other business logic.
* ORMService takes care of generating Model Objects from the info recovered from the DB as table registries.
* parameters.yml stores config info.




**THING TO BE IMPROVED**

* Missing the filters by colors.

* Not very happy with the `url_prefix` solution given to give a base root to urls.

* Currency hardcoded in templates should be replaced by some configurable option, so we could easily change it if necessary.

* paymentAction implemented as a GET method. Should be a POST but it allowed me to keep some stuff more simple.

* A lot of validations have been skipped (for forms, info entered by the user, both in front and backend) to keep it simple.

* A lot of error management has been skipped. Missing exception management and proper error message both in the frontend and logs with technical details regarding some errors.

* Naming conventions for css classes should be improved.

* parameters.yml shouldn't be pushed to github but a .dist version. First because it stores sensitive info (DB password) and also data that changes from one server/env to the other.

* I really don't like the approach that I took in the code to put together products and colors. I would cahnge it to a view in the database that put tables together and this way the conversion between the database and the Product Model would be way simpler.

* Payment (both front and backend) should only be available when a user is logged.

* No time for unit tests.
