<?php


namespace App\Interfaces;


use App\Models\Compagnie;

interface iScrap
{
    public function getCompagnyId();
    public function getTitle();
    public function getSubtitle();
    public function getIntro();
    public function getDescription();
    public function getMainPhoto();
    public function getPrice();
    public function getDureeDuVol();
}