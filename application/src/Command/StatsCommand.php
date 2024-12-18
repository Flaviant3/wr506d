<?php

namespace App\Command;

use App\Repository\MovieRepository;
use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(name: 'app:stats')]
class StatsCommand extends Command
{
    private MovieRepository $movieRepository;
    private ActorRepository $actorRepository;
    private CategoryRepository $categoryRepository;
    private MailerInterface $mailer;

    public function __construct(
        MovieRepository $movieRepository,
        ActorRepository $actorRepository,
        CategoryRepository $categoryRepository,
        MailerInterface $mailer
    ) {
        parent::__construct();
        $this->movieRepository = $movieRepository;
        $this->actorRepository = $actorRepository;
        $this->categoryRepository = $categoryRepository;
        $this->mailer = $mailer;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Affiche les statistiques des films, acteurs et catégories et les envoie par email.')
            ->addArgument('type', InputArgument::REQUIRED, 'Type de statistiques à afficher')
            ->addOption('log-file', null, InputOption::VALUE_OPTIONAL, 'Chemin vers le fichier de log', 'var/log/stats.log')
            ->addOption('email', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Destinataires de l\'email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');
        $output->writeln("Type de statistiques demandé : $type");

        $results = [];
        $movieCount = $this->movieRepository->count([]);
        $results[] = "Nombre de films : $movieCount";

        $actorCount = $this->actorRepository->count([]);
        $results[] = "Nombre d'acteurs : $actorCount";

        $categoryCount = $this->categoryRepository->count([]);
        $results[] = "Nombre de catégories : $categoryCount";

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $filmCountInCategory = count($category->getMovies());
            $results[] = "Catégorie '{$category->getTitle()}': $filmCountInCategory films";
        }

        // Écrire dans le fichier texte
        $logFile = $input->getOption('log-file') ?: 'var/log/stats.log';
        file_put_contents($logFile, implode(PHP_EOL, $results) . PHP_EOL, FILE_APPEND);

        // Envoyer un email si des destinataires sont spécifiés
        $emails = $input->getOption('email');
        if ($emails) {
            $this->sendEmail($emails, $results);
        }

        return Command::SUCCESS;
    }

    private function sendEmail(array $recipients, array $results): void
    {
        $email = (new Email())
            ->from('flaviant3@gmail.com')
            ->to(...$recipients)
            ->subject('Statistiques des Films')
            ->text(implode(PHP_EOL, $results));

        $this->mailer->send($email);
    }
}
