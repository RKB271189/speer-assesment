<?php

namespace App\Services;

use App\Models\Note;

final class NoteService extends MainServiceRepository
{
    private $table;

    public function __construct(Note $note)
    {
        $this->table = $note;
        parent::__construct($this->table);
    }
    public function filter(string $query): ?array
    {
        $collection = Note::whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", [$query])
            ->get();
        return ($collection) ? $collection->toArray() : null;
    }
}
