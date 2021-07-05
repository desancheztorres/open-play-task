<p align="center"><a href="https://openplay.net" target="_blank"><img src="https://openplay.net/wp-content/uploads/2020/05/op-inline-transparent-1.png" width="400"></a></p>


## OpenPlay Pricing Coding Task
OpenPlay manages the cost of all items inside the system as pricing options which are related to purchasable 
products such as classes, memberships and swimming goggles. These prices may be modified or overridden in certain 
scenario based on configurable rules. We would like you to design a small pricing engine that attempts to produce a price using the input of a user, the venue 
at which the purchase is occurring, and the product. You should factor in the configuration of the modifiers
related to the pricing option and apply relevant adjustments separately to determine the lowest applicable price.

- Take an input of (Product + Venue + Member).
- Fetch the product's related pricing option.
- Check the configured adjustments for that pricing option 
  by applying them to the base price on the pricing option.
- Return the cheapest applicable price for the scenario.

For simplicity, the adjustments do not need to stack or interact with each other, you can check the applicable
adjustments separately and return the lowest price for which the member qualifies. If no adjustment
is found, simply return the base price from the pricing option object. We've also combined the conditions of the
pricing modifier and the modification itself into one object, e.g. the age condition the type of modifier (multiplier) are bound together. 
In the real world you may wish to separate these two ideas.

Consider that new modifiers may need to be added in future and performance should be good enough
to run in real-time. As a bonus, the system could produce some level of accountability about which rules it used 
or disregarded to arrive at the lowest possible price.

Some example scenarios to consider:
- If the customer is under 25, reduce the base price by 20%.
- If the venue is ‘Glasgow’ the price of the product is £3.
- If the customer has a membership type of ‘platinum’ the product is free (£0).

Implementing these examples should be sufficient to demonstrate the flexibility of the
pattern you’ve used, feel free to add your own scenarios if you would like.

### Output
- A bundle of code that can output a price as per the spec above that demonstrates
your approach to development.
- Some way to execute the code, this could be a simple CLI command, a web page, a php script, or an integration test.  
- Ideally some limited test coverage of what you've done just to demonstrate your ability in this area.
- A brief README description of the approach you took and why, any shortcuts you took, issues encountered etc.

### Schema & Data

We have provided a schema and some models for you and have seeders that will populate the database with data 
to work with. This should help you get started quickly and allow you to focus on the pricing engine rather than 
schema design and seeding. However, what we've done isn't perfect, please feel free to modify the schema and 
seeded data if it's getting in your way. Particularly configuration and types of pricing modifiers are opinionated,
and the simplifications we made there might not suit your approach.

#### Models

We've provided interfaces and models for each object in the `App` and `App/Models` namespaces. 

- Member [members]
  - Basic user object with a string membership type, and a date of birth.
- Product [products]
  - A product with a type and a pricing option relation.
  - We've kept this as one pricing option per product for simplicity.
- Venues [venues]
  - A simple object to use as a context for the purchase to arrive at a price.
- Pricing Option [pricing_options]
  - Contains the base price, a name and a type.
- Pricing Modifier [pricing_modifiers] 
  - A type (which determines how it should be processed/applied) and an array of settings for these stored as json.
  - You may wish to modify this part of the schema to better suit your implementation.
  - Conditions (e.g. age) and the effect on the price (e.g. multiply) are combined here.  
- Pricing Option Pricing Modifier (Pivot) [pricing_options_pricing_modifiers]
  - A pivot that links many modifiers to one pricing option.


### Setup
- This example project can be run using <a href="https://laravel.com/docs/8.x/sail">laravel sail</a> if you have <a href="https://docs.docker.com/get-docker/">docker installed.</a>
- <a href="https://laravel.com/docs/8.x/sail#configuring-a-bash-alias">Add sail as a bash alias</a> or use `./vendor/bin/sail`
- Copy `.env.example` to `.env`
- `docker run --rm --interactive --tty --volume $PWD:/app composer install` to get a one time composer install for sail setup.
- `sail up -d` to get the environment running. You can then use `sail` as a prefix to any command you want to run.
- `sail artisan migrate:fresh` then `sail artisan db:seed` to setup and seed the example database.
- You can stop the environment with `sail down`.
- You can run artisan commands that you need using the `sail` prefix or open a cli using `sail shell` 
- If you need to access the app via the browser you can do so at `http://localhost:8001`
- The port for this can be changed in the .env using `APP_PORT=8002` #

#### MySQL Database
- By default, you can connect to the MySQL container on `localhost` port `3308`.
- If this clashes with your local setup it can be overridden using `FORWARD_DB_PORT=3309` in the `.env` and restart sail.

#### The Task
- I decided to use Hexagonal Architecture to have the domain and business logical separate from Laravel Framework and then will be easier in case to migrate to other frameworks.
- The main files are in the folder src/ and it has been added in composer.json.
- The main file that calculates the lowest price is located in Src\Product\Application\price. It's a use case en the application layout. The issue here is that the usecase knows about Laravel code and this only should be in infrastructure layout, but I found some issues when I was implementing it and I added some Laravel helpers and models in application layout.
- The main issue I found is that the data in the database changes every time you migrate your files and I realized very late that membership_type_flat_adjustment has two different types of settings and sometimes there is only one. So that was the main reason I got some errors.
- I added some test to make sure that all the relationships and database works perfectly.
- I added a feature test with some examples about price discounts.
- It was an easy task, but when I tried to make the cleanest code as possible, I found some difficulties.
- I really enjoyed it, I learned a lot, there were some things I didn't do it for ages, and it was good to remember them.
- And the way it is done, the relationships, tables, a json for settings, it is really good, it makes a lot of sense.
