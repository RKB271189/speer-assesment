<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Services\NoteService;
use Exception;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(private NoteService $noteService)
    {
    }
    public function index()
    {
        try {
            $notes = $this->noteService->getAll();
            return response()->json(['message' => 'Success', 'notes' => $notes], 200);
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function save(CreateNoteRequest $request)
    {
        try {
            $params = $request->only('user_id', 'content');
            $note = $this->noteService->save($params);
            return response()->json(['message' => 'Note created successfully', 'note' => $note], 200);
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function update()
    {
        
    }
    public function note()
    {
    }
}
