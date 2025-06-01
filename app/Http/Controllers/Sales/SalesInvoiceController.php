<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    public function index(){
        return view("pages.sales.invoice.index");
     }
}
