<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Utilitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *for th english version
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();
        //dd($utilities);
        return view('frontend.contact.contact',['cartTotal'=>$cartTotal,'cartCount'=>$cartCount,'utilities'=>$utilities]);
    }
    //for the arab version
    public function indexAr()
    {
        $cartTotal = \Cart::getTotal();
        $cartCount = \Cart::getContent()->count();
        $utilities = Utilitie::first();
        return view('Arfrontend.contact.contact',['cartTotal'=>$cartTotal,'cartCount'=>$cartCount,'utilities'=>$utilities]);
    }
    // admin panel root
    public function indexAdmin()
    {
        $messages = Message::all();
        return view('admin.messages.index',['messages'=> $messages]);
    }
    public function getAdminMessages()
    {
        $messages = Message::all();
        if (!$messages) {
            return response()->json([
                "status" => 404,
                "message" => "there is no messages !"
            ]);
        }else {
            return response()->json([
                "status" => 200,
                "message" => "All Messages !",
                "messages" => $messages
            ]);
        }
    }
    //handle actions comming from admin
    public function handleAction($action,Request $request){
        $messages = $request->input('messages');
        foreach ($messages as $id){
            $message = Message::where('id',$id)->first();
            if (! isset($message)) {
                return response()->json([
                    "status" => 200,
                    "message" => "message not found!".$id,
                ]);

            }else {
                switch ($action) {
                    case 'delete':
                         $message->delete();
                    //      return response()->json([
                    //     "status" => 200,
                    //     "message" => "message deleted!".$id,
                    //  ]);
                        break 1;
                        case 'seen':
                            $message->update([
                                'status'=>'read'
                            ]);
                        //     return response()->json([
                        //    "status" => 200,
                        //    "message" => "message updated!".$id,
                        // ]);
                           break 1;
                           case 'unseen':
                            $message->update([
                                'status'=>'unread'
                            ]);
                        //     return response()->json([
                        //    "status" => 200,
                        //    "message" => "message updated!".$id,
                        // ]);
                           break 1;
                }

            }

        }
        // foreach($messages as $id){
        //     $message = Message::where('id',$id)->first();
        //     switch ($action) {
        //         case 'unseen':
        //            if (isset($message)) {
        //             return response()->json([
        //                 "status" => 200,
        //                 "message" => "unseen !".$id,
        //             ]);
        //            }
        //             break 1;

        //         default:
        //         if (isset($message)) {
        //             return response()->json([
        //                 "status" => 200,
        //                 "message" => "seen !".$id,
        //             ]);
        //            }
        //             break;
        //     }
        // }
        // return response()->json([
        //     "status" => 200,
        //     "message" => "All Messages !",
        //     "messages" => $action
        // ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name'=> "nullable|string",
            'email' => "nullable|string",
            'text' => "nullable|string"
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $message = Message::create([
            'name'=> $request->name,
            'email' => $request->email,
            'text' => $request->text
        ]);
        if ($user) {
            $message->update([
                'user_id' => $user->id
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
