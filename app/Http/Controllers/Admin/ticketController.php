<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\changeStatusTicket;
use App\Notifications\ticketReplay;
use App\Notifications\ticketAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ticketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('parent', '=', 0)->latest()->paginate(10);
        

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $id)
    {
        $ticket = $id;
        $status = Status::all();
        $conversation = Ticket::where('parent', $ticket->id)
            ->get();
        return view('admin.tickets.show', compact('ticket', 'status', 'conversation'));
    }
    
     public function show_admin(Ticket $id)
    {
        $ticket = $id;
        $status = Status::all();
        $conversation = Ticket::where('parent', $ticket->id)->orWhere('user_id',$ticket-user_id)->orWhere('sendTo','admin')->get();
        return view('admin.tickets.show', compact('ticket', 'status', 'conversation'));
    }


    public function new_ticket()
    {

        $users = User::all();

        return view('admin.tickets.new', compact('users'));
    }
    
    public function store_ticket(Request $request)
    {
            $request->validate([
            'description' => 'required|max:60000',
        ]);
        $ticket =     Ticket::create([
            'description' =>  ' ',
            'title' => $request->title,
            'user_id' => $request->user_id,
            'parent' => 0,
            'sendTo'=>1
        ]);
        
            $fileName = null;
         
        if ($request->file != null) {
            $fileName = 'ticket_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path(env('UPLOAD_FILE_Ticket')), $fileName);
        }
        
         Ticket::create([
            'description' => $request->description,
            'title' => $request->title,
            'user_id' => 'admin',
            'file' => $fileName,
            'parent' => $ticket->id
        ]);
          $user = User::find($request->user_id);
        try {
            $user->notify(new ticketAdmin($ticket->id));
        } catch (\Exception $exception) {
            Log::error('send sms for reply ticket error: ' . $exception->getMessage());
        }

            alert()->success('تیکت با موفقیت ثبت شد.')->autoclose(5000);
        return redirect()->back();
        
    }

    public function changeStatusAjax(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update([
            'status_id' => $request->status_id,
        ]);
        $user = User::find($ticket->user_id);
        $status = Status::find($request->status_id)->title;
        $user->notify(new changeStatusTicket($status));
        return response()->json([1]);
    }

    public function replay(Request $request)
    {
        $request->validate([
            'description' => 'required|max:60000',
        ]);
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update([
            'status_id' => 3,
        ]);
              $fileName = null;
        if ($request->has('file')) {
            $fileName = 'ticket_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path(env('UPLOAD_FILE_Ticket')), $fileName);
        }
        Ticket::create([
            'description' => $request->description,
            'parent' => $request->ticket_id,
            'user_id' => 'admin',
            'title' => $ticket->title,
            'file'=>$fileName,
            'status_id' => 3,
        ]);
        $ticket->update([
            'status_id' => 3,
        ]);
        //GET USER INFO
        $user = User::find($request->user_id);
        try {
            $user->notify(new ticketReplay($ticket->id));
        } catch (\Exception $exception) {
            Log::error('send sms for reply ticket error: ' . $exception->getMessage());
        }


        alert()->success('پاسخ با موفقیت ارسال شد')->autoclose(5000);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        try {
            DB::beginTransaction();
            $parent_tickets = Ticket::where('parent', $id)->get();
            foreach ($parent_tickets as $item) {
                $item->delete();
            }
            $tickets = Ticket::where('id', $id)->first();
            $tickets->delete();
            $msg = 'سطر مورد نظر با موفقیت حذف شد';
            DB::commit();
            return response()->json([1, $msg]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([0, $exception->getMessage()]);
        }
    }
}
