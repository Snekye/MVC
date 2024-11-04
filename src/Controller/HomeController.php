<?php
namespace App\Controller;

use App\DB;
use App\Model\Book;
use App\Model\Movie;
use App\Model\Album;
use App\Controller\AbstractController;

class HomeController extends AbstractController {
    public function index() {
        global $prefix;
        
        $db = new DB();
        $albums = $db->getAll(Album::class);
        $books = $db->getAll(Book::class);
        $movies = $db->getAll(Movie::class);
        $medias = array_merge($albums, $books, $movies);

        $this->render("home", [
            "prefix" => $prefix,
            "user" => $_SESSION['user'],
            "medias" => $medias,
        ]);
    }
}