<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class KoszulkiControllerTest extends WebTestCase
{
    public function testKoszulki()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/koszulki');
    }

}
