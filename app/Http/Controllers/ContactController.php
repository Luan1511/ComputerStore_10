<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Xác thực dữ liệu từ form
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email',
            'contactSubject' => 'nullable|string|max:255',
            'contactMessage' => 'nullable|string',
        ]);

        // Dữ liệu email
        $data = [
            'name' => $validatedData['customerName'],
            'email' => $validatedData['customerEmail'],
            'subject' => $validatedData['contactSubject'] ?? 'No Subject',
            'message' => $validatedData['contactMessage'] ?? 'No Message',
        ];

        Mail::send([], [], function ($message) use ($data) {
            $message->to('luanpvc.23ai@vku.udn.vn') // Thay bằng email của bạn
                ->subject($data['subject']);
            $message->from($data['email'], $data['name']);

            // Nội dung email dưới dạng chuỗi HTML
            $message->setBody("<h4>Name: {$data['name']}</h4>
                              <h4>Email: {$data['email']}</h4>
                              <p>Message: {$data['message']}</p>", 'text/html');
        });

        if (Mail::failures()) {
            return redirect()->back()->with('error', 'Failed to send email. Please try again.');
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
