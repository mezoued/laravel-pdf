<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Employee;
use PDF;

class EmployeeController extends Controller {

    // Display user data in view
    public function showEmployees(){
      $employee = Employee::all();
      return view('home', compact('employee'));
    }

    public function Show($id)
    {
      $employee = Employee::find($id);
      return view('client', compact('employee'));
    }

    // Generate PDF
    public function createPDF2($id) {
      // retreive all records from db
      $data = Employee::find($id);

      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdfclient', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }

    // Generate PDF
    public function createPDF() {
      // retreive all records from db
      $data = Employee::all();

      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdf', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }

    

}