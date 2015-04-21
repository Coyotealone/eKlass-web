# webservice

Coyote
Symfony Standard Edition

Pichon WebSite Welcome to the Symfony Standard Edition - a fully-functional Symfony2 application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start using Symfony. For a more detailed explanation, see the Installation chapter of the Symfony Documentation.
1) Installing the Standard Edition

When it comes to installing the Symfony Standard Edition, you have the following options.
Use Composer (recommended)

As Symfony uses Composer to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

curl -s http://getcomposer.org/installer | php

Then, use the create-project command to generate a new Symfony application:

php composer.phar create-project symfony/framework-standard-edition path/to/install

Composer will install Symfony and all its dependencies under the path/to/install directory.
Download an Archive File

To quickly test Symfony, you can also download an archive of the Standard Edition and unpack it somewhere under your web server root directory.

If you downloaded an archive "without vendors", you also need to install all the necessary dependencies. Download composer (see above) and run the following command:

php composer.phar install

2) Checking your System Configuration

Before starting coding, make sure that your local system is properly configured for Symfony.

Execute the check.php script from the command line:

php app/check.php

The script returns a status code of 0 if all mandatory requirements are met, 1 otherwise.

Access the config.php script from a browser:

http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.
3) Browsing the Demo Application

Congratulations! You're now ready to use Symfony.

From the config.php page, click the "Bypass configuration and go to the Welcome page" link to load up your first Symfony page.

You can also use a web-based configurator by clicking on the "Configure your Symfony Application online" link of the config.php page.

To see a real-live Symfony page in action, access the following page:

web/app_dev.php/demo/hello/Fabien

4) Getting started with Symfony

This distribution is meant to be the starting point for your Symfony applications, but it also contains some sample code that you can learn from and play with.

A great way to start learning Symfony is via the Quick Tour, which will take you through all the basic features of Symfony2.

Once you're feeling good, you can move onto reading the official Symfony2 book.

A default bundle, AcmeDemoBundle, shows you Symfony2 in action. After playing with it, you can remove it by following these steps:

delete the src/Acme directory;

remove the routing entry referencing AcmeDemoBundle in app/config/routing_dev.yml;

remove the AcmeDemoBundle from the registered bundles in app/AppKernel.php;

remove the web/bundles/acmedemo directory;

empty the security.yml file or tweak the security configuration to fit your needs.

What's inside?

The Symfony Standard Edition is configured with the following defaults:

Twig is the only configured template engine;

Doctrine ORM/DBAL is configured;

Swiftmailer is configured;

Annotations for everything are enabled.

It comes pre-configured with the following bundles:

FrameworkBundle - The core Symfony framework bundle

SensioFrameworkExtraBundle - Adds several enhancements, including template and routing annotation capability

DoctrineBundle - Adds support for the Doctrine ORM

TwigBundle - Adds support for the Twig templating engine

SecurityBundle - Adds security by integrating Symfony's security component

SwiftmailerBundle - Adds support for Swiftmailer, a library for sending emails

MonologBundle - Adds support for Monolog, a logging library

AsseticBundle - Adds support for Assetic, an asset processing library

WebProfilerBundle (in dev/test env) - Adds profiling functionality and the web debug toolbar

SensioDistributionBundle (in dev/test env) - Adds functionality for configuring and working with Symfony distributions

SensioGeneratorBundle (in dev/test env) - Adds code generation capabilities

All libraries and bundles included in the Symfony Standard Edition are released under the MIT or BSD license.

Enjoy!

5) Project WS

    OK -> Entities (Mapping) + PhpDoc
    OK -> Fixtures
    OK -> Tests (php phpunit.phar -c app/ src/Coyote/ApiBundle/Tests/)
    OK -> API Rest (/api/*) / Doc (/api/doc/*)
    OK -> API Json-RPC 
    NOK -> API : Rest (Pas compris)
    
    + OK -> SonataAdmin (/admin/*)


