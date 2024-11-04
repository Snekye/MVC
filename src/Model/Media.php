<?php
namespace App\Model;

abstract class Media {
    const DBTYPES = [
        "title" => "varchar(255)",
        "author" => "varchar(255)",
        "available" => "bool",
    ];

    private ?string $title = null;
    private ?string $author = null;
    private ?bool $available = null;

    public function loan() {
        $this->available = false;
    }
    public function return() {
        $this->available = true;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }


    public function getAuthor(): ?string
    {
        return $this->author;
    }
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }


    public function getAvailable(): ?bool
    {
        return $this->available;
    }
    public function setAvailable(?bool $available): void
    {
        $this->available = $available;
    }
}
?>