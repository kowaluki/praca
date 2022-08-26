# Praca - my own project on github.com

Hello World!  This is my first seriously project on github.com for my first future job. My name is Łukasz Kowalski and i will present you my first MVC app created in PHP.


### at the begging...

I am begginer at that, so please - be nice :)  I plan that this application will be used to calculate calculations for customers through the company. It will works also for sign in **( two-factor)**, sign up by a companies, creating users, and many many others :)

In my previous repository i didn't use README.md and comments too often, so I prefer to keep it like not doing projects on github.

I have a few projects, but they are not particularly impressive. I prefer to have them for examples of using particular functionalities in future projects.

[My previous projects](https://cv.kowaluki.pl).

## Technologies

I am using clear PHP code (trying use the newest version ,but... I don't know exactly, propably 8) for back-end (front-end i will describe if i will use that - not now).

I prefer non-relational databases like MongoDB because I can send my JSON and the database takes it as is!

## First steps: REST API

### Basic website file calls

We need basic files in our websites - html, css, js, xml. In my app we will call them as follows:

1. HTML files - `/websites/{file_name}`
2. XML files - `/xml/{file_name}`
3. JavaScript files - `/scripts/{file_name}` 
4. CSS stylesheets -`/styles/{file_name}`


In `{file_name}` do not use file extension - we know that scripts
ends in .js and stylesheets ends in .css, and so on...

### We need some modules!
Yes - I created modules, but at the moment just one, menu. How to call that?

`/modules/navigation`

i am gonna to describe this in the next two days, but you can take a look at the examples in index.php.

Code for menu: 

```
["Home page","noMore","http://127.0.0.1/strony/praca/"],
            ["About:", "more",
                [
                    ["About Us","noMore","http://127.0.0.1/strony/praca/AboutUs"],
                    ["About App","noMore","http://127.0.0.1/strony/praca/AboutApp"],
                    ["Contact:","more",
                        [
                            ["Via e-mail","noMore","mailto:kowaluki1@gmail.com"],
                            ["Via phone","noMore","tel:+48795397851"]
                        ]
                    ]
                ]
            ]
```

In short: 

* `Home Page`, `About us` - link name
* `noMore` / `more` - attribute specifying whether there will be an indentation in the list or not (inheritance)
* More arrays / `127.0.0.1` - More arrays means will be indentation; https address means link

...and what is the result?

1. Home page
2. About:
   * About Us
   * About App
   * Contact:
      * Via email
      * Via phone


You can load modules on website by, for example, jQuery, like that:


`$("nav").load("modules/navigation")`.

## Activation

I am using that on Apache server on lampp on my notebook on Linux Fedora 36 (workstation), in folders `strony/praca/`.

## Contact
For my part, that's all for now. I will update this file regulary in future (i hope so :D)

