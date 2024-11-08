<?php

// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/api/register', name: 'api_user_register', methods: ['POST'])]
    public function apiRegister(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $user = new User();
        $data = json_decode($request->getContent(), true);

        // Assurez-vous que les données sont présentes
        if (!isset($data['email'], $data['name'], $data['password'])) {
            return $this->json(['error' => 'Missing fields'], Response::HTTP_BAD_REQUEST);
        }

        $user->setEmail($data['email']);
        $user->setName($data['name']); // Utilisez setName au lieu de setUsername
        $user->setPassword($data['password']);

        // Hachage du mot de passe
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        // Définir le rôle par défaut
        $user->setRoles(['IS_AUTHENTICATED_FULLY']);

        $entityManager->persist($user);
        $entityManager->flush();

        // Retournez le message et l'ID de l'utilisateur
        return $this->json([
            'message' => 'Utilisateur créé avec succès',
            'id' => $user->getId(), // Ajoutez l'ID ici
        ], Response::HTTP_CREATED);
    }
}
