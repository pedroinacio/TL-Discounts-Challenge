# TL Discounts-Challenge

I decided to solve the challenge using Lumen, a micro-framework based in Laravel. 
I usually use Laravel for all my projects but I'm curious to check how 'stunningly faster', Lumen is.

## Author

* **Pedro Inácio** - *Full Stack Web Developer* - [Linkedin](www.linkedin.com/in/pedro-inácio-7bab7922/)

## Instalation
For those unfamiliar with the lumen/laravel framework, clone the project and change the *.env* file on the project *root*.  You can find all relevant classes in the *app/Http/Controllers/* folder, and test file in the *tests* folder. Routes go in the *routes/web.php*. Run the tests using *vendor/bin/phpunit --debug* command. It's a very simple group of tests to check the status code and structure of the response, depending of the type of discount used.
There is a SQL dump on the root as well. Just import the *teamleader.sql* file.
My thanks to the very helpfull Advanced REST Client Extension for Chrome(https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo)