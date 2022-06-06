<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606211544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        /*$beers_query = "INSERT INTO beer (api_id,name,tagline,image_url,abv) VALUES
        (1,'Buzz','A Real Bitter Experience.','https://images.punkapi.com/v2/keg.png',4.5),
        (2,'Trashy Blonde','You Know You Shouldn''t','https://images.punkapi.com/v2/2.png',4.1),
        (3,'Berliner Weisse With Yuzu - B-Sides','Japanese Citrus Berliner Weisse.','https://images.punkapi.com/v2/keg.png',4.2),
        (4,'Pilsen Lager','Unleash the Yeast Series.','https://images.punkapi.com/v2/4.png',6.3),
        (5,'Avery Brown Dredge','Bloggers'' Imperial Pilsner.','https://images.punkapi.com/v2/5.png',7.2),
        (6,'Electric India','Vibrant Hoppy Saison.','https://images.punkapi.com/v2/6.png',5.2),
        (7,'AB:12','Imperial Black Belgian Ale.','https://images.punkapi.com/v2/7.png',11.2),
        (8,'Fake Lager','Bohemian Pilsner.','https://images.punkapi.com/v2/8.png',4.7),
        (9,'AB:07','Whisky Cask-Aged Scotch Ale.','https://images.punkapi.com/v2/9.png',12.5),
        (10,'Bramling X','Single Hop IPA Series - 2011.','https://images.punkapi.com/v2/10.png',7.5);
   INSERT INTO ctta.beer (api_id,name,tagline,image_url,abv) VALUES
        (11,'Misspent Youth','Milk & Honey Scotch Ale.','https://images.punkapi.com/v2/keg.png',7.3),
        (12,'Arcade Nation','Seasonal Black IPA.','https://images.punkapi.com/v2/12.png',5.3),
        (13,'Movember','Moustache-Worthy Beer.','https://images.punkapi.com/v2/13.png',4.5),
        (14,'Alpha Dog','Existential Red Ale.','https://images.punkapi.com/v2/14.png',4.5),
        (15,'Mixtape 8','An Epic Fusion Of Old Belgian, American New Wave, And Scotch Whisky.','https://images.punkapi.com/v2/15.png',14.5),
        (16,'Libertine Porter','Dry-Hopped Aggressive Porter.','https://images.punkapi.com/v2/16.png',6.1),
        (17,'AB:06','Imperial Black IPA.','https://images.punkapi.com/v2/17.png',11.2),
        (18,'Russian Doll – India Pale Ale','Nesting Hop Bomb.','https://images.punkapi.com/v2/18.png',6.0),
        (19,'Hello My Name Is Mette-Marit','Lingonberry Double IPA.','https://images.punkapi.com/v2/19.png',8.2),
        (20,'Rabiator','Imperial Wheat Beer','https://images.punkapi.com/v2/keg.png',10.27);
   INSERT INTO ctta.beer (api_id,name,tagline,image_url,abv) VALUES
        (21,'Vice Bier','Hoppy Wheat Bier.','https://images.punkapi.com/v2/keg.png',4.3),
        (22,'Devine Rebel (w/ Mikkeller)','Oak-aged Barley Wine.','https://images.punkapi.com/v2/22.png',12.5),
        (23,'Storm','Islay Whisky Aged IPA.','https://images.punkapi.com/v2/23.png',8.0),
        (24,'The End Of History','The World''s Strongest Beer.','https://images.punkapi.com/v2/24.png',55.0),
        (25,'Bad Pixie','Spiced Wheat Beer.','https://images.punkapi.com/v2/25.png',4.7);";*/

        $beers_query = "INSERT INTO beer (api_id,name,tagline,image_url,abv) VALUES ";
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.punkapi.com/',
            //'verify' => false,
            \GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath()
            
        ]);
        $response = $client->request('GET', '/v2/beers');
        $body = $response->getBody();

        $data = json_decode((string)$body);
        
        $fields = ["id",'name','tagline',"image_url","abv"];
        $dbInserts = [];
        
        foreach ($data as $value) {
            $dbRecord = [];
            foreach ($fields as $fieldName){
                $dbRecord[$fieldName] = $value->$fieldName;
            }
            $dbInserts[] = $dbRecord;
        }

        foreach ($dbInserts as $entry) {
            $this->addSql('INSERT INTO beer (api_id,name,tagline,image_url,abv) VALUES 
                (:id,:name,:tagline,:image_url,:abv)', $entry);
        }
        //$this->addSql($beers_query);       
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE beer');
    }
}
