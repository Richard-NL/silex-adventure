<?php
namespace Rsh\Adventure\Command;

use Knp\Command\Command;
use Rsh\Adventure\Service\DirectionServiceClient;
use Rsh\Adventure\InputHelper\InputHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;


class AdventureCommand extends Command
{
    private $directionServiceClient;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->directionServiceClient = DirectionServiceClient::create();
    }

    protected function configure()
    {
        $this
          ->setName("adventure")
          ->setDescription("Let us visit some places");
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $inputHelper = new InputHelper($helper, $input, $output);
        $currentLocation = 'Muddy Beach';
        
        question:
        $question = new Question('>', false);

        $userInputText = trim($helper->ask($input, $output, $question));
        
        if ($inputHelper->isExitTypedAndConfirmed($userInputText)) {
            // @todo extract
            $question = new ConfirmationQuestion('Are you sure? ', false);
            if ($this->helper->ask($this->input, $this->output, $question)) {
                return;
            }
        }

        if ($inputHelper->isInventoryTyped($userInputText)) {
            $output->writeln('<info>You currently have:</info>');
            $output->writeln('nothing!');
        }

        if ($inputHelper->isGoToTyped($userInputText)) {
            $output->writeln('<info>Where do you wish to go:</info>');
            $directions = $this->directionServiceClient->getDirections($currentLocation);
            foreach ($directions as $key => $direction) {
                $output->writeln($direction);
            }
        }

        if ($inputHelper->isGoToWithDirectionValid($userInputText, $this->directionServiceClient->getDirections($currentLocation))) {

        }
        
        goto question;
    }
}
