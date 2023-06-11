<?php
/**
 * Rental entity.
 */

namespace App\Entity;

use App\Repository\RentalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Rental.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: RentalRepository::class)]
class Rental
{
    /**
     * Primary key.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Email.
     */
    #[ORM\Column(length: 62)]
    private ?string $email = null;

    /**
     * Comment.
     */
    #[ORM\Column(length: 250)]
    private ?string $comment = null;

    /**
     * User.
     */
    #[ORM\ManyToOne(inversedBy: 'rentals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * Book.
     */
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    /**
     * Getter for Id.
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for email.
     *
     * @return string|null Email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for email.
     *
     * @param string|null $email Email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Getter for comment.
     *
     * @return string|null Comment
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Setter for comment.
     *
     * @param string|null $comment Comment
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Getter for user.
     *
     * @return User|null User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Setter for user.
     *
     * @param User|null $user Name
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Getter for book.
     *
     * @return Book|null Book
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * Setter for book.
     *
     * @param Book|null $book Book
     */
    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
