<?php
namespace App\Model;

use App\Model\Media;
use App\Enum\MovieGenre;

class Movie extends Media {
    const DBTYPES = [
        "id" => "id",
        "duration" => "float",
        "genre" => "Enum/MovieGenre"
    ] + parent::DBTYPES;

    private ?int $id = null;
    private ?float $duration = null;
    private ?MovieGenre $genre = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getDuration(): ?float
    {
        return $this->duration;
    }
    public function setDuration(?float $duration): void
    {
        $this->duration = $duration;
    }


    public function getGenre(): ?MovieGenre
    {
        return $this->genre;
    }
    public function setGenre(?MovieGenre $genre): void
    {
        $this->genre = $genre;
    }
}
?>