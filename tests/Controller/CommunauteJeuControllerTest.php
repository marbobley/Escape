<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommunauteJeuControllerTest extends WebTestCase
{
    public function testIndexPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', "Bienvenu à vous, membre de la communauté!");
    }

    public function testPremierNiveauLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute/premier_niveau');
        self::assertResponseIsSuccessful();
    }

    public function testPremierePierreDescendreWithoutKeyShowsFall(): void
    {
        $client = static::createClient();
        // Ensure we started the level to initialize the session
        $client->request('GET', '/communaute/premier_niveau');
        $crawler = $client->request('GET', '/communaute/premier_niveau/premier_pierre_descendre');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', "Vous manquez malheureusement de point d'appuie et vous tombez !!");
    }

    public function testPremierePierreDescendreWithKeyShowsSecondDescendPage(): void
    {
        $client = static::createClient();
        // Start the level
        $client->request('GET', '/communaute/premier_niveau');
        // Pick up the second key (clef-4)
        $client->request('GET', '/communaute/premier_niveau/deuxieme_pierre_enlever');

        // Now descending by the first stone should render the second page (no fall)
        $client->request('GET', '/communaute/premier_niveau/premier_pierre_descendre');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', "Finalement, avec les points d'appuis suffisant, vous arrivez à retomber dans une petite alvéole avec une porte !");
    }

    public function testDeuxiemePierreDescendreLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute/premier_niveau/deuxieme_pierre_descendre');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', "Finalement, avec les points d'appuis suffisant, vous arrivez à retomber dans une petite alvéole avec une porte !");
    }

    public function testPremierPierreEnleverThenFormShows(): void
    {
        $client = static::createClient();
        // Start the level
        $client->request('GET', '/communaute/premier_niveau');
        // Take the first key (clef-33)
        $client->request('GET', '/communaute/premier_niveau/premier_pierre_enlever');

        // Go to the second level door page (form page)
        $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau');
        self::assertResponseIsSuccessful();
        // The form should be present
        self::assertSelectorExists('form');
    }

    public function testDeuxiemePierreEnleverAddsKeyAndAffectsFlow(): void
    {
        $client = static::createClient();
        // Start the level to init session
        $client->request('GET', '/communaute/premier_niveau');

        // Take the second key (clef-4)
        $client->request('GET', '/communaute/premier_niveau/deuxieme_pierre_enlever');

        // Visit the open form page and ensure the alert may not appear about missing objects if both keys later exist
        $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau');
        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form');
    }

    public function testJeuDeuxFormGoodPassRedirectsToBonPass(): void
    {
        $client = static::createClient();
        $client->followRedirects(false);

        $crawler = $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau');
        self::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Repondre')->form([
            'form[pass]' => '33-4',
        ]);
        $client->submit($form);

        self::assertResponseRedirects('/communaute/premier_niveau/deuxieme_niveau/ouverture');
    }

    public function testJeuDeuxFormBadPassRedirectsToMauvais(): void
    {
        $client = static::createClient();
        $client->followRedirects(false);

        $crawler = $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau');
        self::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Repondre')->form([
            'form[pass]' => 'wrong',
        ]);
        $client->submit($form);

        self::assertResponseRedirects('/communaute/premier_niveau/deuxieme_niveau/mauvais');
    }

    public function testDeuxiemeNiveauBrutePageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau_brute');
        self::assertResponseIsSuccessful();
    }

    public function testDeuxiemeNiveauBonPassPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau/ouverture');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('p', 'Le gnome vous laisse passer');
    }

    public function testDeuxiemeNiveauMauvaisPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/communaute/premier_niveau/deuxieme_niveau/mauvais');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('a.btn.btn-info', 'Retenter');
    }
}
