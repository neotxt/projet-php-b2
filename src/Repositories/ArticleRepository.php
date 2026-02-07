<?php

namespace Repositories;

class ArticleRepository implements Repository
{
    public function create(object $article)
    {
        // Créer un nouvel article dans la bdd
    }

    public function read(int $id)
    {
        // Lis les informations d'un article dans la bdd
    }

    public function update(object $article)
    {
        // Met à jour les informations d'un article dans la bdd
    }

    public function delete(int $id)
    {
        // Supprime un article dans la bdd
    }
}
