<?php

namespace App\Service;

use App\Entity\Boat;
use App\Entity\Tile;
use App\Repository\TileRepository;

class MapManager
{
    private $tileRepository;

    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;

    }
    public function tileExists(int $x, int $y): bool
    {
        $tile = $this->tileRepository->findOneBy( [
            'coordX' => $x,
            'coordY' => $y,
        ]);

        if ($tile) {
            return true;
        } else {
            return false;
        }

    }

    public function getRandomIsland(): Tile
    {
        $tile = $this->tileRepository->findBy([
            'type' => 'island'
        ]);

        return $tile[array_rand($tile)];
    }

    public function checkTreasure(Boat $boat): bool
    {
        $tile = $this->tileRepository->findOneBy([
            'coordY' => $boat->getCoordY(),
            'coordX' => $boat->getCoordX()
        ]);

        if ($tile->getHasTreasure()){
            return true;
        } else {
            return false;
        }
        return $tile;

    }

}