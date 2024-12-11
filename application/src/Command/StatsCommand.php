<?php

namespace App\Command;

use App\Repository\MovieRepository;
use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:stats', description: 'Retourne des statistiques sur les films, acteurs et catégories.')]
class StatsCommand extends Command
{
    private $movieRepository;
    private $actorRepository;
    private $categoryRepository;

    public function __construct(MovieRepository $movieRepository, ActorRepository $actorRepository, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->movieRepository = $movieRepository;
        $this->actorRepository = $actorRepository;
        $this->categoryRepository = $categoryRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $nbMovies = $this->movieRepository->count([]);
        $nbActors = $this->actorRepository->count([]);
        $nbCategories = $this->categoryRepository->count([]);

        $output->writeln("Nombre de films : $nbMovies");
        $output->writeln("Nombre d'acteurs : $nbActors");
        $output->writeln("Nombre de catégories : $nbCategories");

        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category) {
            $nbMoviesInCategory = count($category->getMovies());
            $output->writeln("Catégorie : {$category->getTitle()} - Nombre de films : $nbMoviesInCategory");
        }

        return Command::SUCCESS;
    }
}