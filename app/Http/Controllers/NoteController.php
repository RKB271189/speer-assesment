<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\NoteQueryRequest;
use App\Services\NoteService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(private NoteService $noteService, private UserService $userService)
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
    public function note($id)
    {
        try {
            $note = $this->noteService->findById($id);
            return response()->json(['message' => 'Success', 'note' => $note], 200);
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
    public function update(CreateNoteRequest $request, $id)
    {
        try {
            $params = $request->only('user_id', 'content');
            $note = $this->noteService->update($id, $params);
            return response()->json(['message' => 'Note updated successfully', 'note' => $note], 200);
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $this->noteService->delete($id);
            return response()->json(['message' => 'Note deleted successfully'], 200);
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function share(Request $request, $id)
    {
        try {
            $userid = $request->input('user_id');
            $note = $this->noteService->findById($id);
            $user = $this->userService->findById($userid);
            $note->users()->attach($user);
            return response()->json(['message' => 'Note shared successfully'], 200);
        } catch (Exception $ex) {
            //Write the logs here            
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function search(NoteQueryRequest $request)
    {
        try {
            $query = $request->input('q');
            $notes = $this->noteService->filter($query);
            return response()->json(['message' => 'Success', 'notes' => $notes], 200);
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
