<?php

namespace App\Service;

interface PromotionCodesServiceInterface
{
    public function getAll();
    public function show(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
}
