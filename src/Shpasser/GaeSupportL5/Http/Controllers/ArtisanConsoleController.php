<?php

namespace Shpasser\GaeSupportL5\Http\Controllers;

use Illuminate\Routing\Controller;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Input;
use Artisan;

/**
 * Artisan Console Controller for GAE.
 */
class ArtisanConsoleController extends Controller
{
    const NON_INTERACTIVE = ' -n';

    /**
     * Shows the Artisan Console page.
     * @return mixed view containing the Artisan Console.
     */
    public function show()
    {
        $command = '';
        $results = '';
        return view('gae-support-l5::artisan', compact(['command', 'results']));
    }

    /**
     * Executes a command submitted from Artisan Console page.
     * @return mixed view containing the Artisan Console.
     */
    public function execute()
    {
        $command = Input::get('command');

        if ($command === '') {
            $command = 'list';
        }

        $output= new BufferedOutput;

        Artisan::handle(new StringInput($command.self::NON_INTERACTIVE), $output);
        $results = $output->fetch();

        return view('gae-support-l5::artisan', compact(['command', 'results']));
    }
}
