<?php
namespace Rsh\Adventure\Command;

use Knp\Command\Command;
use Rsh\Adventure\InputHelper\ActionHandler;
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
        $inputHelper = new InputHelper();
        $currentLocation = 'Muddy Beach';
        
        question:
        $question = new Question('>', false);

        $userInputText = trim($helper->ask($input, $output, $question));
        $actionHandler = new ActionHandler($inputHelper);
        $action = $actionHandler->getAction($userInputText);
        $output->writeln(get_class($action) . ' instance found');
        
        goto question;
    }
}
