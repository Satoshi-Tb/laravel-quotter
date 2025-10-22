<?php

namespace App\Http\Controllers\Quoot\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quser;
use App\Models\Quoot;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $quootId)
    {
        $userId = Auth::id();
        $quser = Quser::where('id', $userId)->firstOrFail();
        $quoot = Quoot::where('id', $quootId)->firstOrFail();

        if ($userId === $quoot->user_id) {
            return view('quoot.update')->with(
                [
                'quootId' => $quoot->id,
                'content' => $quoot->content,
                'userName' => $quser->user_name,
                ]
            );
        } else {
            abort(403);
        }
    }
}
