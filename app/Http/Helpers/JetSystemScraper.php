<?php


namespace App\Http\Helpers;


use App\Interfaces\iScrap;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class JetSystemScraper implements iScrap
{

    protected Client $client;
    protected string $url;
    protected Crawler $crawler;
    public int $responseCode;
    protected int $compagny_id;

    /**
     * JetSystemScraper constructor.
     * @param  string  $url
     * @param  int $compagny_id
     */
    public function __construct(string $url, int $compagny_id)
    {
        $this->url = $url;
        $this->client = new Client();
        $this->crawler = $this->client->request('GET', $url);
        $this->responseCode = $this->client->getInternalResponse()->getStatusCode();
        $this->compagny_id = $compagny_id;
    }

    /**
     * Retourne la compagny_id
     * @return int
     */
    public function getCompagnyId()
    {
        return $this->compagny_id;
    }

    /**
     * Retourne le title de la page
     * @return string|string[]
     */
    public function getTitle()
    {
        return $this->crawler->filterXPath('//h1/text()')->text();
    }

    /**
     * Retourne le sous-titre
     * @return string
     */
    public function getSubtitle()
    {
        return str_limit($this->crawler->filterXPath('//meta[@property=\'og:description\']/@content')->text(), 150);
    }

    /**
     * Retourne l'intro (description limité à 150 caractères
     * @return string
     */
    public function getIntro()
    {
        return str_limit($this->crawler->filterXPath('//meta[@property=\'og:description\']/@content')->text(), 150);
    }

    /**
     * Retourne le texte descriptif
     * @return string
     */
    public function getDescription()
    {
        if( !empty ( $this->crawler->filterXPath('//*[@id=\'single_product_page_container\']/div/div[2]/p/strong/text()' ) ) ) {
            return $this->crawler->filterXPath('//*[@id=\'single_product_page_container\']/div/div[2]/p/strong/text()')->text( self::getIntro() );
        }
        else{
            return $this->crawler->filterXPath('//*[@id=\'single_product_page_container\']/div/div[2]/p/text()')->text();
        }
    }

    /**
     * Retourne une image
     * @return false|string
     */
    public function getMainPhoto()
    {
        //1. creé la signature "context" du user-agent pour passer la fonction php file_get_content
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );

        //2. récupère l'url de l'image
        $url_to_image = $this->crawler->filterXPath('//meta[@property=\'og:image\']/@content')->text();

        //3. verif sur le rep. /tmp, création si no exist
        if(!is_dir( storage_path('app/public/tmp'))) mkdir(storage_path('app/public/tmp'));

        //4. set le path pour stockage
        $my_save_dir = storage_path('app/public/tmp');

        //5. récupère le nom du fichier image
        $filename = basename($url_to_image);

        //6. set le path complet pour file_put_contents
        $complete_save_loc = $my_save_dir.'/'.$filename;

        //7. fait un put content sur le get content optimisé avec la signature de firefox
        file_put_contents( $complete_save_loc, file_get_contents($url_to_image, false, $context) );

        return $filename;
    }

    /**
     * Retourne le prix
     * @return string|string[]
     */
    public function getPrice()
    {
        return str_replace(',00 €', '', $this->crawler->filterXPath('//*[@class=\'wpsc_product_price\']/p/span/text()')->text());
    }

    /**
     * Retourne la durée du vol
     * @return mixed
     */
    public function getDureeDuVol()
    {
        return filter_var($this->crawler->filterXPath('//*[@id="single_product_page_container"]/div/div[1]')->text(), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
    }
}