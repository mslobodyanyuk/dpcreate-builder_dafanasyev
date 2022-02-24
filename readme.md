Design Pattern ► [ Builder ] ► Lesson №12
=========================================

* ***Actions on the deployment of the project:***

- Making a new project dpcreate-builder_dafanasyev.loc:
																	
	sudo chmod -R 777 /var/www/DESIGN_PATTERNS/Creational/dpcreate-builder_dafanasyev.loc

	//!!!! .conf
	sudo cp /etc/apache2/sites-available/test.loc.conf /etc/apache2/sites-available/dpcreate-builder_dafanasyev.loc.conf
		
	sudo nano /etc/apache2/sites-available/dpcreate-builder_dafanasyev.loc.conf

	sudo a2ensite dpcreate-builder_dafanasyev.loc.conf

	sudo systemctl restart apache2

	sudo nano /etc/hosts

	cd /var/www/DESIGN_PATTERNS/Creational/dpcreate-builder_dafanasyev.loc

- Deploy project:

	`git clone << >>`
	
	`or Download`
	
	_+ Сut the contents of the folder up one level and delete the empty one._

	`composer install`
	
---

Dmitry Afanasyev

[Design Pattern ►[ Builder ] ► Lesson #12 (16:10)]( https://www.youtube.com/watch?v=tKF_dY8UHMg&list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&index=11&ab_channel=DmitryAfanasyev )

The Builder is a Creational Design Pattern that allows you to create complex objects step by step. The Builder makes it possible to use the same construction code to obtain different representations of objects.

<https://refactoring.guru/ru/design-patterns/builder>

We will also consider where the Builder Design Pattern is used in Laravel.

	composer create-project --prefer-dist laravel/laravel
	
_+ Сut the contents of the folder up one level and delete the empty one._

	php artisan make:controller CreationalPatternsController

Error: 
_"... Permission denied"_

	sudo chmod -R 777 /var/www/DESIGN_PATTERNS/Creational/dpcreate-builder_dafanasyev.loc

Error: 
_"Target class [CreationalPatternsController] does not exist."_
		
<https://stackoverflow.com/questions/63807930/target-class-controller-does-not-exist-laravel-8>		
		
Add route in `routes/web.php`:

```php
use App\Http\Controllers\CreationalPatternsController;

Route::get('/', [CreationalPatternsController::class, 'Builder'])->name('dump');
```

	php artisan config:cache	
	php artisan config:clear

Error:
_"Class 'Debugbar' not found"_

<https://bestofphp.com/repo/barryvdh-laravel-debugbar-php-debugging-and-profiling>

	composer require barryvdh/laravel-debugbar --dev

![screenshot of sample]( https://github.com/mslobodyanyuk/dpcreate-builder_dafanasyev/blob/main/public/images/firefox1.png )	

[(0:05)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=5 ) The topic of today's video is the Creational Design Pattern Builder.

_"The Builder is a Creational Design Pattern that allows you to create complex objects step by step."_

<https://refactoring.guru/ru/design-patterns/builder>

What does this mean. - We have some complex object, it has a lot of properties, and instead of creating this object using the constructor( - using `new` ) and filling in a long "string" of some properties,
we take and remove this responsibility from the current Class into some other Class, which will be called `Builder`. And, instead of creating with a single iteration - the process of creating is broken down into certain steps.
Each step will be filling in one or another property of the object we need.

[(1:15)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=75 ) Those sources that we used earlier agree on one thing ...

[(1:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=90 )
_"So, let's get down to the code..."_

We have some complex object, let's say it's a Blog Article OR an Order. Orders can be extremely complex, consisting of many different properties... And the standard way of Creating with a constructor is NOT convenient enough.
For two reasons:

1. "row" of properties. - And when the function already has more than three input variables, parameters - it does NOT turn out very beautifully ... And when the "row" - it turns out to be NOT beautiful at all, badly readable, hard to perceive.

2. In different places of our Application, it may be required that we will Fill in some properties during Creation, we will NOT Fill in some. That is, different States of objects when directly Creating objects...

[(3:20)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=200 ) Therefore, we take out the Logic of Creating an object from the object itself into an auxiliary Class, which will be called the `Builder`. - With it, we will
To build this complex Class and moreover `Builder`, it will be so flexible that we can Create different variations of the object of the same Class.

[(4:00)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=240 ) `BlogPostBuilder.php`

`Builder` has an Interface.

[(4:10)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=250 ) `BlogPostInterface.php`

- `public function create(): BlogPostInterface` - which Creates a "dummy" of our resulting Class that we will Create. It just makes `new` and THAT IS ALL, DOES NOT give any properties.

Next come the setters, in which we have ALL the necessary properties that we may need to the maximum, we can endow them. In this case, these are `setTitle()`, `setBody()`, `setCategories()`, `setTags()`.

- `public function getBlogPost(): BlogPost` - one could just call `get` which will give us the resulting object. Already EITHER with Filled properties, OR "blank" IF we called immediately after `create()`.

[(5:00)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=300 ) `CreationalPatternsController.php`

Let's consider the simplest way to use `Builder`. - Let's Create our `Builder`.

```php
$builder = new BlogPostBuilder();
```

[(5:25)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=325 ) `BlogPostBuilder.php`

When a constructor is called, `create()` is called. That is, when creating the `BlogPostBuilder` object, we immediately Create a "dummy" target object, which we will Create and endow it with properties. - The next step is to set the Title, Post Body, Categories, Tags and
directly The output is `getBlogPost(): BlogPost`. We put the result in the `$result` variable, even Call the `create()` method to Update our `private $blogPost` property so that we can continue to work with `Builder`. - Do NOT recreate it again,
Do NOT call the `create()` method directly from somewhere. IF we did a `get()`, we have the result AND our `target-object` is set to zero. 

```php
public function getBlogPost(): BlogPost
{
	$result = $this->blogPost;
	$this->create();

	return $result;
}
```

[(6:40)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=400 ) 
_"Now let's see how to use it."_

`$builder` - Created, we have a "dummy" there. Give it a `setTitle()` and Get the `getBlogPost()` Class object `BlogPost` empty, except that it has a `setTitle()` in the `$posts[]` array of posts.

`CreationalPatternsController.php`

```php
$posts[] = $builder->setTitle('from Builder')
				   ->getBlogPost();
```

On the one hand, it is convenient, we can use it like this. - You can go a little further and complicate our Design Pattern, Make the so-called Manager. In descriptions in various sources, it is called the Director.
BUT, in my opinion, the Manager is more suitable.

[(7:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=450 ) `BlogPostManager.php`

Contains the hidden Logic of Creating objects, Scenarios so to speak. As I said earlier, in different places of our Application it may turn out that we need an instance of a Class with different properties...
Therefore, it is easier to Separate the Logic, Scripts for Creating Objects into a separate Class `BlogPostManager.php`

- `	public function setBuilder(BlogPostBuilderInterface $builder)` - Installing Builder.

And then there are the Scenario methods:

- `public function createCleanPost()` - when we need a clean `BlogPost`. We call `$builder` and "say" give us a `BlogPost`, THAT'S ALL.

- `public function createNewPostIt()` - when we need a blank, a blank for an article about IT technologies:

- set the Title `->setTitle('Новый пост про IT')`

- set the Body `->setBody('Новый пост про IT...')`

- assign Categories `->setCategories(['категория_it',])`

- assign Tags `->setTags(['tag_it','tag_programming',]))`

- And we Give the result `->getBlogPost();`

We issue a `BlogPost` with ALL of these triggered properties.

Next comes the next Scenario. This is Creating a new article for a blog, an article about cats...

- `public function createNewPostCats()` - "body" I lowered it so that there would NOT be an idea that ALL steps must be used. - NO, we can use some steps, skip some... Title, Categories, Tags assigned,
 
Post Received and issued.

```php
public function createNewPostCats()
{
	$blogPost = $this->builder
		->setTitle('Новый пост про кошек')
		->setCategories([
			'категория_кошки',
			'категория_питомцы',
			])
		->setTags([
			'tag_cats',
			'tag_pets',
		])
		->getBlogPost();

	return $blogPost;
}
```
 
[(9:50)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=590 ) 

_"Let's see how this ALL will work."_

`CreationalPatternsController.php` 

We Received our Manager, gave him an Employee ... Then we turn to the Manager - a manager, we need a clean Post. The Manager with his Employee Creates this Post and Gives it to us. We DO NOT touch the Employee...
Further we "say" Give us a post on IT. - They "went" it together. They did EVERYTHING and he (- Manager) returned the result to us. Similarly with the Post about cats.
THAT'S ALL, we have placed it, now we can view it.

```php
$manager = new BlogPostManager();
$manager->setBuilder($builder);

$posts[] = $manager->createCleanPost();
$posts[] = $manager->createNewPostIt();
$posts[] = $manager->createNewPostCats();
```

[(10:45)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=645 ) `Refresh Browser(F5).` "Messages".

![screenshot of sample]( https://github.com/mslobodyanyuk/dpcreate-builder_dafanasyev/blob/main/public/images/firefox2.png )

The first `BlogPost` is what came to us from `Builder`. - We ONLY initiated Title and got it right away. EVERYTHING else is empty.

- Further there is absolutely empty `BlogPost`. It's just our "blank".

- Next Post dedicated to IT-technologies.

- Next Post dedicated to cats.

----

[(11:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=690 ) Example 2

_"To broaden your understanding, maybe one Example will NOT be clear enough for you..."_

I will also give an example, regarding an online store, Creating an Order ... The Order Class itself can be extremely complex, it can be very simple. What are the Scenarios for creating an Order. - For example, an Order can be Created by a user from the site, and it can have two stages:

The First stage, the First Scenario, is Preorder Creation. That is, we get the same "Order", BUT it has some properties initiated AND there is a property, a flag, that this is "preOrder".
A "preOrder" is the same "Order", with the difference that we understand that it is under development by the Client. Managers may or may not see it. Let's say they can see in the List of ALL Orders, BUT they can NOT edit ...

[(12:50)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=770 ) The Second Scenario is the Creation of an Order directly by the Manager in the "Admin" in `CRM`. For example, IF the Manager made a sale by phone, he can Create an Order in the "Administrator" instead of the Client.
And in this case, he does NOT need to Create a "preOrder" that mutates into an "Order". - He needs to immediately Create an Order from the "Administrator". Accordingly, this is already a new Scenario, and we can even put a label, property-flag to establish that this Order was Created in the "Administrator".

[(13:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=810 ) We can come up with a Third Scenario.

For example, there is some third-party site that works with your online store using `API`. From that site, the Client can also Place an Order, and the Order will come via `API`. - Accordingly, we Create EVERYTHING the same instance of the "Order" Class, BUT according to a different Scenario and already
some other properties will be triggered. In that chill, we can also put a marker that the Order was Created by `API`, it came from that site.

----

[(14:05)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=845 ) Example 3

Where in `LARAVEL` itself `Builder` is used. - IF you took my course on `LARAVEL`, the following lines will be familiar to you.

```php
$f = User::select(['id', 'name', 'email'])
			->whereIn('id', [1,2])
			->orderBy('id', 'desc')
			->get()
;
dd($f);
```

[(14:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=870 ) We have a `users` table, we have a `User` model. We access the `Builder` through the model. In the same way, step by step We create the result, methods-steps, and the `get()` method - getting the result.
That is, the `get()` method works for us EXACTLY the same as the `getBlogPost()` method. We initialize the columns, "say" which columns we want to get.

_"If necessary, for the Example, Create a database with the `users` table OR use the existing one and specify the connection settings to it in `.env`"_

`User::select(['id', 'name', 'email']))` - we DO NOT need ALL columns.

`->whereIn('id', [1,2])` - where identifier must be 1 OR 2.

`->orderBy('id', 'desc')` - sorting by `id` in reverse order.

`->get()` - we get.

[(15:20)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=920 ) IF we Call now - We will get a result that meets our requirements.

![screenshot of sample]( https://github.com/mslobodyanyuk/dpcreate-builder_dafanasyev/blob/main/public/images/firefox3.png )

[(15:30)]( https://youtu.be/tKF_dY8UHMg?list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&t=930 ) BUT IF we "mask" `//->get()` and look, we will see that this is our `Builder`. IF I'm not mistaken, this is our `Eloquent-Builder`.
Because the `Builders` dedicated to databases in `LARAVEL` are many different...

```php
/*Eloquent*/
$f = User::select(['id', 'name', 'email'])
			->whereIn('id', [1,2])
			->orderBy('id', 'desc')
			//->get()
;
dd($f);
```

Designed according to the `Builder` Design Pattern.

![screenshot of sample]( https://github.com/mslobodyanyuk/dpcreate-builder_dafanasyev/blob/main/public/images/firefox4.png )

#### Useful links:

Dmitry Afanasyev

[Design Pattern ►[ Builder ] ► Lesson #12]( https://www.youtube.com/watch?v=tKF_dY8UHMg&list=PLoonZ8wII66inyWXuikmI0ANxC9tKgZPY&index=11&ab_channel=DmitryAfanasyev )

<https://stackoverflow.com/questions/63807930/target-class-controller-does-not-exist-laravel-8>

<https://bestofphp.com/repo/barryvdh-laravel-debugbar-php-debugging-and-profiling>

<https://ru.wikipedia.org/wiki/Строитель_(шаблон_проектирования)>

Examples

<https://refactoring.guru/ru/design-patterns/builder>

<https://nixsolutions.github.io/design-patterns/creational/builder/>

[https://habr.com/]( https://habr.com/ru/company/vk/blog/325492/ )