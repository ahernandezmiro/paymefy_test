<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

use App\Services\FetchUsersServiceFactory;
use App\Repository\CSVUserRepository;
use App\Repository\XMLUserRepository;
use App\Repository\DBUserRepository;

(new SingleCommandApplication())
    ->addArgument('export-type', InputArgument::REQUIRED, 'The export strategy (csv/xml/db)')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        // output arguments and options
        if(!in_array($input->getArgument('export-type'), array('csv', 'xml', 'db'))){
            echo "Invalid export option. Supported values are csv/xml/db";
            die();
        }

        $users = array();
        $fetchers = FetchUsersServiceFactory::getAllFetchUsersServices();

        foreach($fetchers as $fetcher){
            $users = array_merge($users, $fetcher->fetch());
        }

        $ur;
        if($input->getArgument('export-type') == 'csv')
            $ur = new CSVUserRepository();
        else if($input->getArgument('export-type') == 'xml')
            $ur = new XMLUserRepository();
        else if($input->getArgument('export-type') == 'db')
            $ur = new DBUserRepository(
                '127.0.0.1',
                'database',
                'user',
                'pass'
            );

        $ur->store($users);       
    })
    ->run();
