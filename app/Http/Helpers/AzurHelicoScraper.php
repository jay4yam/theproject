<?php


namespace App\Http\Helpers;


use App\Interfaces\iScrap;

class AzurHelicoScraper implements iScrap
{
    protected int $compagny_id;

    public function __construct(string $url, int $compagny_id)
    {
        $this->url = $url;
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

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    public function getSubtitle()
    {
        // TODO: Implement getSubtitle() method.
    }

    public function getIntro()
    {
        // TODO: Implement getIntro() method.
    }

    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

    public function getMainPhoto()
    {
        // TODO: Implement getMainPhoto() method.
    }

    public function getPrice()
    {
        // TODO: Implement getPrice() method.
    }

    public function getDureeDuVol()
    {
        // TODO: Implement getDureeDuVol() method.
    }
}