<?php

/**
 * Book fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class BookFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class BookFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(50, 'books', function (int $i) {
            $book = new Book();
            $book->setTitle($this->faker->word);
            $book->setIsbn(
                $this->faker->isbn13()
            );
            $book->setReleaseDate(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-156324 days', '-1 days')
                )
            );
            $book->setPageNumber($this->faker->numberBetween(15, 2000));
            $book->setRating($this->faker->numberBetween(0, 10));
            $book->setDescription($this->faker->text);
            $book->setStock($this->faker->numberBetween(0, 15));

            $author = $this->getRandomReference('authors');
            $book->addAuthor($author);

            $category = $this->getRandomReference('categories');
            $book->addCategory($category);

            return $book;
        });

        $this->manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: AuthorFixtures::class, CategoryFixtures::class}
     */
    public function getDependencies(): array
    {
        return [AuthorFixtures::class, CategoryFixtures::class];
    }
}
