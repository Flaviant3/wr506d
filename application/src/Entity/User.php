<?php
// src/Entity/User.php
<<<<<<< HEAD

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
=======
namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
>>>>>>> develop
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
<<<<<<< HEAD
use ApiPlatform\Metadata\QueryParameter;
=======
>>>>>>> develop
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class, validationContext: ['groups' => ['Default', 'user:create']]),
        new Get(),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email')]
<<<<<<< HEAD
#[ApiFilter(SearchFilter::class, properties: ['email' => 'exact'])]

=======
>>>>>>> develop
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups(['user:read'])]
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;
<<<<<<< HEAD

=======
>>>>>>> develop
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    #[ORM\Column(length: 180, unique: true)]
<<<<<<< HEAD
    public ?string $email = null;

    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private ?string $plainPassword = null;

=======
    private ?string $email = null;
    #[ORM\Column]
    private ?string $password = null;
    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private ?string $plainPassword = null;
>>>>>>> develop
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 255)]
<<<<<<< HEAD
    #[Assert\NotBlank]
    #[Groups(['user:read', 'user:create', 'user:update'])]
    private ?string $name = null;

=======
    private ?string $name = null;
>>>>>>> develop
    public function getId(): ?int
    {
        return $this->id;
    }
<<<<<<< HEAD

=======
>>>>>>> develop
    public function getEmail(): ?string
    {
        return $this->email;
    }
<<<<<<< HEAD

=======
>>>>>>> develop
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
<<<<<<< HEAD

=======
    /**
     * @see PasswordAuthenticatedUserInterface
     */
>>>>>>> develop
    public function getPassword(): string
    {
        return $this->password;
    }
<<<<<<< HEAD

=======
>>>>>>> develop
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
<<<<<<< HEAD

=======
>>>>>>> develop
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
<<<<<<< HEAD

=======
>>>>>>> develop
    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
<<<<<<< HEAD

    public function getRoles(): array
    {
        $roles = $this->roles;
        // Assurez-vous que chaque utilisateur a au moins ce rôle
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

=======
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
>>>>>>> develop
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
<<<<<<< HEAD

=======
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
>>>>>>> develop
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
<<<<<<< HEAD

    public function eraseCredentials(): void
    {
        $this->plainPassword = null; // Efface le mot de passe en clair
=======
    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
>>>>>>> develop
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
<<<<<<< HEAD
        return $this;
    }
}
=======

        return $this;
    }
}
>>>>>>> develop
