<?php

namespace App\Command;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class CalculateAgeCommand extends Command
{
    private $Manager;

    public function __construct(ContainerInterface $container)
    {
        $this->Manager = $container->get('app.age_calculator.manager');
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:calculate-age')
            ->setDescription('Sužinokite savo amžių')
            ->addArgument('bornDate', InputArgument::REQUIRED, 'Gimimo data')
            ->addOption(
                'adult',
                null,
                InputOption::VALUE_NONE,
                'Parodome ar žmogus pilnametis'
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $bornDate = $input->getArgument('bornDate');

        if($input->getOption('adult') !== false){
            $age = $this->Manager->ageCalculator->getAge($bornDate);
            $io->note(sprintf('Jums yra: %s', $age));
            //$io->writeln('<error>foo</error>');
            $io->success(sprintf('Jūs esate: %s', $this->Manager->isAdult->isAdult($age)));
        }else{
            $io->note(sprintf('Jums yra: %s', $this->Manager->ageCalculator->getAge($bornDate)));
        }

    }
}