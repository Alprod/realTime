<?php

namespace App\Tests;

use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

class SessionTest extends PantherTestCase
{
    private const SESSION_TITLE = 'Intergrate (Vue)JS components in a Symfony app, add E2E tests with Panther';

    use ReloadDatabaseTrait;

    public function testGiveFeedback()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame('Real time', $crawler->filter('h1:first-of-type')->text());

        $client->waitFor('#feedback div p');
        $this->assertSame('Désolé pas de feedback...', $crawler->filter('#feecback div p'));

        $client->takeScreenshot('/tmp/panther.png');
    }
}
