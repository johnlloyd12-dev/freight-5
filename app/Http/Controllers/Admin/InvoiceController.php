<?php

namespace App\Http\Controllers\Admin;
use App\Models\fms_g15_payments;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use PDF;
use Stripe\Stripe;
use App\Models\Invoices;
use Stripe\Climate\Order;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\fms_g18_formdetails;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
public function index(){
    $formdetails = fms_g18_formdetails::all();
    return view('admin.invoices.index',compact('formdetails'));
    }
public function view()
    {
        $invoice = Invoices::latest()->paginate(5);
        return view('invoices.index',compact(''))->with('i', (request()->input('page',1)-1)*5);
    }
public function add()
    {
        return view('admin.invoices.add');
    }
public function manage()
{
  
$formdetails = fms_g18_formdetails::all();
    return view('admin.manage.manage',compact('formdetails'));
}

public function invoiceview($id)
{
    
    // Retrieve form details associated with the provided ID
    $formdetails = fms_g18_formdetails::findOrFail($id);
    
    // Get the user_id of the form being viewed
    $userId = $formdetails->user_id;
    
    // Retrieve all form details associated with the user_id
    $test = fms_g18_formdetails::where('user_id', $userId)->get();
    
    // Pass the form details to the view
    return view('admin.invoices.view', compact('formdetails','test'));
}

public function payment()
{
    return view('admin.payment.payment');
}
public function stripe(Request $request)
{

        // $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        // $response= $stripe->checkout->sessions->create([
        // 'line_items' => [
        //     [
        //     'price_data' => [
        //         'currency' => 'usd',
        //         'product_data' => [
        //             'name' => $request->product_name,
        //         ],
        //         'unit_amount' => $request->price*100,
        
            
        //     ],
        //     'quantity' => $request->quantity,
        //     ],
        // ],

        // 'mode' => 'payment',
        // 'success_url' => route('success'),'?session_id={CHECKOUT_SESSION_ID}',
        // 'cancel_url' => route('cancel'),
        // ]);
        // dd($response);
        // if(isset($response->id) && $response->id !=''){
        //     return redirect($response->url);
        // }  else{
        //     return redirect()->route('cancel');
        // }

        //TESTING1
        // $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        // $response = $stripe->checkout->sessions->create([
        //     'line_items' => [
        //         [
        //             'price_data' => [
        //                 'currency' => 'usd',
        //                 'product_data' => [
        //                     'name' => $request->product_name,
        //                 ],
        //                 'unit_amount' => $request->price * 100,
        //             ],
        //             'quantity' => $request->quantity,
        //         ],
        //     ],
        //         'mode' => 'payment',
        //         'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
        //         'cancel_url' => route('cancel'),
        // ]);
        // // dd($response);
        //         if(isset($response->id) && $response->id !=''){
        //     return redirect($response->url);
        // }  else{
        //     return redirect()->route('cancel');
        // }

        ////test2

        // try {
        //     $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
    
        //     $response = $stripe->checkout->sessions->create([
        //         'line_items' => [
        //             [
        //                 'price_data' => [
        //                     'currency' => 'usd',
        //                     'product_data' => [
        //                         'name' => $request->product_name,
        //                     ],
        //                     'unit_amount' => $request->price * 100,
        //                 ],
        //                 'quantity' => $request->quantity,
        //             ],
        //         ],
        //         'mode' => 'payment',
        //         'success_url' => route('success'),
        //         'cancel_url' => route('cancel'),
               
        //     ]);
        //     // dd($response);
        //     // Replace {CHECKOUT_SESSION_ID} with the actual session ID
        //     $successUrl = str_replace('{CHECKOUT_SESSION_ID}', $response->id, route('success'));
            
    
        //     // Now you can redirect the user to the updated success URL
        //     return redirect($successUrl);
        // } catch (\Exception $e) {
        //     // Handle errors
        //     return redirect()->route('cancel')->with('error', 'An error occurred. Please try again later.');
        // }

        //test3
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        $response = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->product_name,
                        ],
                        'unit_amount' => $request->price * 100,
                    ],
                    'quantity' => $request->quantity,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
            // Add customer information, description, and date to the metadata
            'metadata' => [
                'customer_email' => $request->customer_email,
                'description' => $request->description,
                'date' => now()->toIso8601String(), // Add the current date in ISO 8601 format
            ],

        ]);
        
        // Redirect the user based on the response
        if (isset($response->id) && $response->id != '') {
            session()->put('product_name', $request->product_name);
            session()->put('quantity', $request->quantity);
            session()->put('price', $request->price);
            return redirect($response->url);
        } else {
            return redirect()->route('cancel');
        }

}

public function success(Request $request)
{
    if(isset($request->session_id)) {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        //dd($response);

        $payment = new fms_g15_payments();
        $payment->payment_id = $response->id;
        $payment->product_name = session()->get('product_name');
        $payment->quantity = session()->get('quantity');
        $payment->amount = session()->get('price');
        $payment->currency = $response->currency;
        $payment->customer_name = $response->customer_details->name;
        $payment->customer_email = $response->customer_details->email;
        $payment->payment_status = $response->status;
        $payment->payment_method = 'Stripe';
        $payment->save();

     return "Payment successful";
     session()->forget('product_name');
     session()->forget('quantity');
     session()->forget('price');
    } else {
    return redirect()->route('cancel');
    }
}

public function cancel(Requets $request)
{
    return "Payment is cancelled";
}

public function payments()
{
    $payments = fms_g15_payments::all();
    return view('admin.paymentshistory.paymentshistory')->with('payments',$payments);
}

public function vieworder($id)
{
    $formdetails = optional(fms_g18_formdetails::findOrFail($id));
    return view('admin.invoices.view', compact('formdetails'));
}

//public function generate(int $orderId)
public function generatePdf($id)
{
    //$order = Order::findOrFail($orderId);
    //return view('admin.invoices.generate', compact('order'));
    // $email = \App\Models\fms_g18_formdetails::distinct()->pluck('email');
    //test 2
    
    // $form = fms_g18_formdetails::all();
    // return view('admin.invoices.generate', compact('form'));

    // // Fetch form details associated with the provided ID
    // $formdetails = fms_g18_formdetails::findOrFail($id);

    // // Get the user_id of the form being viewed
    // $userId = $formdetails->user_id;

    // // Retrieve all form details associated with the user_id
    // $form = fms_g18_formdetails::where('user_id', $userId)->get();

    // // Initialize Dompdf
    // $dompdf = new Dompdf();

    // // Pass form details to the PDF view
    // $view = View::make('admin.invoices.generate')->with('formdetails', $formdetails)->with('form', $form);

    // // Get the HTML content of the view
    // $html = $view->render();

    // // Load HTML content into Dompdf
    // $dompdf->loadHtml($html);

    // // Set paper size and orientation (optional)
    // $dompdf->setPaper('A4', 'portrait');

    // // Render HTML as PDF
    // $dompdf->render();

    // // Generate a unique file name
    // $fileName = 'document_' . uniqid() . '.pdf';

    // // Save the PDF content to storage
    // Storage::disk('public')->put($fileName, $dompdf->output());

    // // Save the file name in the database
    // $formdetails->pdf_file = $fileName;
    // $formdetails->save();

    // return redirect()->back()->with('success', 'PDF generated successfully and file name saved.');
    // return dd('ok');

    //test3
    // Fetch form details associated with the provided ID
$formdetails = fms_g18_formdetails::findOrFail($id);

// Get the user_id of the form being viewed
$userId = $formdetails->user_id;

// Retrieve all form details associated with the user_id
$form = fms_g18_formdetails::where('user_id', $userId)->get();

// Initialize Dompdf
$dompdf = new Dompdf();

// Pass form details to the PDF view
$view = View::make('admin.invoices.generate')->with('formdetails', $formdetails)->with('form', $form);

// Get the HTML content of the view
$html = $view->render();

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');

$dompdf->loadHtml($html);

// Render HTML as PDF
$dompdf->render();

// Output PDF directly to the browser for display
$dompdf->stream();

// $dompdf->stream();

// Generate a unique file name
$fileName = 'document_' . uniqid() . '.pdf';

// Save the PDF content to storage
Storage::disk('public')->put($fileName, $dompdf->output());

// Save the file name in the database
$formdetails->pdf_file = $fileName;
// return dd($formdetails);
$formdetails->save();

return redirect()->back()->with('success', 'PDF generated successfully and file name saved.');


}
//public function generateInvoice(int $orderId)

   // {
       //$order = Order::findOrFail($orderId);
       // $data = ['order' => $order ];
       // $pdf = Pdf::loadView('admin.invoices.generate', $data);
      //  $todayDate = Carbon::now()->format('d-m-y');
      //  return $pdf->download('imvoice'.$order->id.'-'.$todayDate.'pdf');
   // }
}