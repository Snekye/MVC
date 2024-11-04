<?php
namespace App\Controller;

use App\DB;
use App\Model\Book;
use App\Model\Movie;
use App\Model\Album;
use App\Controller\AbstractController;

class EditController extends AbstractController {
    public function index() {
        global $prefix;

        $db = new DB();
        $item = $db->getOneById($_POST["media"],$_POST["id"]);

        $this->render("edit", [
            "prefix" => $prefix,
            "item" => $item,
        ]);
    }
}