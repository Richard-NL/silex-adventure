<?php
namespace Rsh\Adventure\Command;

use Knp\Command\Command;

use Rsh\Adventure\Action\ActionStrategy;
use Rsh\Adventure\Action\ExitAction;
use Rsh\Adventure\Action\GoToAction;
use Rsh\Adventure\Service\DirectionServiceClient;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Rsh\Adventure\Action\Subject\NoSubject;

class AdventureCommand extends Command
{

    public function __construct($name = null)
    {
        parent::__construct($name);


        // @todo di container?
        // $this->locationServiceClient = LocationServiceClient::create();
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
        // @todo di container?
        $directionServiceClient = DirectionServiceClient::create();

        $currentLocation = 'A large hole on the Surface';

        $exitCommand = false;
        while (!$exitCommand) {
            $question = new Question('>', false);

            $userInputText = trim($helper->ask($input, $output, $question));

            // @todo di container?
            $actionStrategy = new ActionStrategy();
            $action = $actionStrategy->getAction($userInputText);
            $output->writeln(get_class($action) . ' instance found');

            // @todo refactor to ActionHandler class?
            $exitCommand = (function() use ($action, $output) {
                if ($action instanceof ExitAction) {

                    $output->writeln('Exiting program, goodbye');
                    return true;
                }
                return false;
            })();
            if ($exitCommand) {
                break;
            }

            // @todo refactor to ActionHandler class?
            (function() use ($action, $output, $directionServiceClient, $currentLocation) {
                if ($action instanceof GoToAction === false) {
                    return;
                }

                if ($action->getSubject()->getName() instanceof NoSubject) {
                    $output->writeln('Where do you want to go?');
                    $directionsNames = $directionServiceClient->getDirections($currentLocation);
                    foreach ($directionsNames as $directionName) {
                        $output->writeln($directionName);
                    }

                    return;
                }

                $output->writeln('Going to location ' . $action->getSubject()->getName() . ' (Well not realy)');
                return;

            })();
        }
    }
}
