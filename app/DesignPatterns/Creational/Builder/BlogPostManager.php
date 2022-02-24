<?php

namespace App\DesignPatterns\Creational\Builder;

use App\DesignPatterns\Creational\Builder\Interfaces\BlogPostBuilderInterface;

class BlogPostManager
{
	private $builder;

	public function setBuilder(BlogPostBuilderInterface $builder)
	{
		$this->builder = $builder;

		return $this;
	}

	public function createCleanPost()
	{
		$blogPost = $this->builder->getBlogPost();

		return $blogPost;
	}

	public function createNewPostIt()
	{
		$blogPost = $this->builder
			->setTitle('Новый пост про IT')
			->setBody('Новый пост про IT...')
			->setCategories([
				'категория_it',
				])
			->setTags([
				'tag_it',
				'tag_programming',
			])
			->getBlogPost();

		return $blogPost;
	}

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

	static public function getDescription()
	{
        $description = [
                    'name' => 'Строитель (Builder)',
                    'url' => 'App\Http\Controllers\CreationalPatternsController@Builder',

                    'text_guru' => 'Строитель — это порождающий паттерн проектирования, который позволяет создавать сложные объекты пошагово. Строитель даёт возможность использовать один и тот же код строительства для получения разных представлений объектов.',
                    'url_guru' => 'https://refactoring.guru/ru/design-patterns/builder',

                    'text_nixsolutions' => 'Строитель (англ. Builder) — это интерфейс для инкапсулирования механизма создания сложного объекта. Суть его заключается в том, чтобы отделить процесс
                        создания некоторого сложного объекта от его представления.
                        Таким образом, можно получать различные представления объекта, используя один и тот же “технологический” процесс. Данный шаблон очень тесно переплетается с шаблоном Фабрика.',
                    'url_nixsolutions' => 'https://nixsolutions.github.io/design-patterns/creational/builder/',

                    'text_habr' => 'Шаблон позволяет создавать разные свойства объекта, избегая загрязнения конструктора (constructor pollution). Это полезно, когда у объекта может быть несколько свойств. Или когда создание объекта состоит из большого количества этапов.',
                    'url_habr' => 'https://habr.com/ru/company/vk/blog/325492/',

                    'text_wiki' => 'Строитель (англ. Builder) — порождающий шаблон проектирования предоставляет способ создания составного объекта.',
                    'url_wiki' => 'https://ru.wikipedia.org/wiki/Строитель_(шаблон_проектирования)',
                ];

        return $description;
	}

}
