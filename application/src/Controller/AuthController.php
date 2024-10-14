<?php

// src/Controller/AuthController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\LoginFormAuthenticator;

class AuthController extends AbstractController
{
#[Route('/login', name: 'app_login', methods: ['POST'])]
public function login(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator)
{
$data = json_decode($request->getContent(), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);

if (!$user || !$passwordEncoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
}

// Ici, vous pouvez générer un token JWT ou une session
return $this->json([
'id' => $user->getId(),
'username' => $user->getUsername(),
// Ajoutez d'autres informations si nécessaire
]);
}
}
