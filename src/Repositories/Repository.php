<?php

namespace Repositories;

/*
 * Interface implémentée dans tous les repositories, vont permettre de faire de requêtes SQL à la bdd
 */
interface Repository
{
    public function create(object $entity);
    public function read(int $id);
    public function update(object $entity);
    public function delete(int $id);
}
