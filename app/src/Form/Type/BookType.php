<?php
/**
 * Book type.
 */

namespace App\Form\Type;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

/**
 * Class BookType.
 */
class BookType extends AbstractType implements FormTypeInterface
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array<string, mixed> $options Form options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn')
            ->add('title')
            ->add('pageNumber')
            ->add('releaseDate', DateType::class, ['widget' => 'single_text'])
            ->add('rating')
            ->add('description')
            ->add('stock')
            ->add(
                'author',
                EntityType::class,
                ['class' => Author::class,
                'choice_label' => function ($author): string {
                    return $author->getName();
                }, 'multiple' => true, ]
            )
            ->add(
                'category',
                EntityType::class,
                ['class' => Category::class,
                'choice_label' => function ($category): string {
                    return $category->getName();
                },
                'multiple' => true,
                ]
            )
        ;
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'book';
    }
}
