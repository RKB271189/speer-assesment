<?php

namespace App\Http\Controllers;

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
}
