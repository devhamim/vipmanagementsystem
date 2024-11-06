<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
// use Illuminate\Support\Facades\Auth;
use Auth;
use App\Services\FcmService;

class NotificationController extends Controller
{

    protected $fcmService;

    public function __construct(FcmService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function sendNotification()
    {
        $deviceToken = 'DEVICE_TOKEN'; // Replace with the token from your client
        $title = 'New Payment Added';
        $body = 'A new payment has been added to your account.';

        $response = $this->fcmService->sendNotification($deviceToken, $title, $body);

        return response()->json(['response' => $response]);
    }

    //
    public function index()
{
    $notifications = Auth::user()->notifications()->paginate(20);
    return view('notifications.index', compact('notifications'));
}
public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        // Redirect to the payment edit page if payment_id exists
        if (isset($notification->data['payment_id'])) {
            return redirect()->route('paymentdata.edit', $notification->data['payment_id']);
        }

        return redirect()->back();
}

public function destroy($id)
{
    $notification = DatabaseNotification::find($id);

    if ($notification) {
        // Delete the notification
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }

    return redirect()->route('notifications.index')->with('error', 'Notification not found.');
}

public function saveToken(Request $request)
    {
        // Validate the incoming token
        $request->validate([
            'token' => 'required|string',
        ]);

        // Assuming the user is authenticated, store the token
        $user = Auth::user();
        $user->device_token = $request->token;
        $user->save();

        return response()->json(['message' => 'Device token saved successfully']);
    }

}
