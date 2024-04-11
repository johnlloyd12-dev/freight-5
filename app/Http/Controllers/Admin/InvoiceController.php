<?php

namespace App\Http\Controllers\Admin;
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
use App\Models\fms_g16_orders;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\fms_g18_formdetails;
use App\Models\fms_g15_invoices;

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
  
    $formdetails = fms_g15_invoices::all();
    return view('admin.manage.manage',compact('formdetails'));
}

public function invoiceview($id)
{
    // Retrieve form details associated with the provided ID
    $data = fms_g18_formdetails::findOrFail($id);
    
    // Pass the form details to the view
    return view('admin.invoices.view', compact('data'));
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
    try {
        // Retrieve form details associated with the provided ID
        $data = fms_g18_formdetails::findOrFail($id);

        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Pass form details to the PDF view
        $view = View::make('admin.invoices.generate')->with('formdetails', $data);

        // Get the HTML content of the view
        $html = $view->render();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML as PDF
        $dompdf->render();

        // Generate a unique file name
        $fileName = 'invoice_' . uniqid() . '.pdf';

        // Save the PDF content to storage
        $pdfContent = $dompdf->output();
        Storage::disk('public')->put($fileName, $pdfContent);

        // Create a new record in fms_g15_invoices with the mapped data
        fms_g15_invoices::create([
            'id' => $data->id,
            'invoice_number' => $data->order_id,
            'payment_method' => null, // Set to null or specify payment method logic
            'customer_name' => $data->firstname . ' ' . $data->lastname,
            'company_name' => $data->consigneeName,
            'carrier' => $data->modeSelection,
            'status' => 'Invoice',
        ]);

        return redirect()->back()->with('success', 'PDF generated successfully and file name saved.');
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error generating PDF: ' . $e->getMessage());

        // Return error message
        return redirect()->back()->with('error', 'Error generating PDF. Please try again later.');
    }
}

public function downloadpdf($id)
{
    // Retrieve form details associated with the provided ID
    $data = fms_g18_formdetails::findOrFail($id);

    // Initialize Dompdf
    $dompdf = new Dompdf();

    // Pass form details to the PDF view
    $view = View::make('admin.invoices.generate')->with('formdetails', $data);

    // Get the HTML content of the view
    $html = $view->render();

    // Load HTML content into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation (optional)
    $dompdf->setPaper('A4', 'portrait');

    // Render HTML as PDF
    $dompdf->render();

    // Generate a unique file name
    $fileName = 'invoice_' . uniqid() . '.pdf';

    // Save the PDF content to storage
    $pdfContent = $dompdf->output();
    Storage::disk('public')->put($fileName, $pdfContent);

    // Set the headers for PDF download
    $headers = [
        'Content-Type' => 'application/pdf',
    ];

    // Return the PDF as a download response
    return response()->download(storage_path("app/public/$fileName"), $fileName, $headers);
}


public function mailInvoicce($id)

{
    $formdetails = fms_g18_formdetails::findOrFail($id);
    Mail::to(" $formdetails")->send(new InvoiceMail);
    
   }
}

