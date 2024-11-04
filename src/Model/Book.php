<?php
namespace App\Model;

use App\Model\Media;

class Book extends Media {
    const DBTYPES = [
        "id" => "id",
        "pageNumber" => "int",
    ] + parent::DBTYPES;
    private ?int $id = null;
    private ?int $pageNumber = null;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getPageNumber(): ?int
    {
        return $this->pageNumber;
    }
    public function setPageNumber(?int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }
}
?>