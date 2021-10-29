<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return TicketResource::collection(Ticket::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        return Ticket::create($request->all());
    }

    public function update(Ticket $ticket,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        return $ticket->update($request->all());
    }

    public function destroy(Ticket $ticket)
    {
        return $ticket->delete();
    }
}
