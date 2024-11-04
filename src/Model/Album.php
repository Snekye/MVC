<?php
namespace App\Model;

use App\Model\Media;

class Album extends Media {
    const DBTYPES = [
        "id" => "id",
        "songNumber" => "int",
        "editor" => "varchar(255)",
    ] + parent::DBTYPES;
    private ?int $id = null;
    private ?int $songNumber = null;
    private ?string $editor = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getSongNumber(): ?int
    {
        return $this->songNumber;
    }
    public function setSongNumber(?int $songNumber): void
    {
        $this->songNumber = $songNumber;
    }


    public function getEditor(): ?string
    {
        return $this->editor;
    }
    public function setEditor(?string $editor): void
    {
        $this->editor = $editor;
    }
}
?>