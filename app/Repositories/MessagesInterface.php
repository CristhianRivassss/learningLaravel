<?php

namespace App\Repositories;

interface MessagesInterface
{
    public function getPaginated();
    public function store($validated);
    public function findById($id);
    public function update($id, $request);
    public function destroy($id);
}