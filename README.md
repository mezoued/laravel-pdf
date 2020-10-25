This step by step tutorial allows you to explore the limitless opportunity if you are a newbie laravel developer. In general, PDF files are used to provide some information to the users.

It’s a format that assures a document that can be portrayed the same way, despite what software is used. All of the information required for presenting the document, identically, is installed in the file leaving your documents safe, accessible, and secure for the long term.

PDF is a portable document format and helps us providing the invoices, user manuals, eBooks, application forms, etc. We will understand from starting to finish about how to create a PDF file in Laravel.

We will construct a user list in a table view, and this table view will show the hold the dynamic user records fetched from the database. Lastly, we will see how to export the table view in PDF file format.


Table of Contents
1-Install Laravel Project
2-Install DomPDF Package
3-Configure DomPDF Package
4-Setting Up Model and Migrations
5-Generate Fake Data
6-Define Controller & Route
7-Display Users List
8-Export To PDF
9-Conclusion

1-Install Laravel Project
composer create-project laravel/laravel laravel-pdf --prefer-dist

2-Install DomPDF Package in Laravel
composer require barryvdh/laravel-dompdf

3-Configure DomPDF Package in Laravel
Open config/app.php file and incorporate DomPDF service provider in providers array along with DomPDF facade to the aliases array.

'providers' => [
  Barryvdh\DomPDF\ServiceProvider::class,
],

'aliases' => [
  'PDF' => Barryvdh\DomPDF\Facade::class,
]

Execute the following command to publish the assets from vendor.

php artisan vendor:publish

Ultimately, you can take the DomPDF in service to convert HTML to PDF File in Laravel using the following attribute.

use PDF;

4-Setting Up Model and Migrations
Create a new Model for Employee using the given below command.

php artisan make:model Employee -m
Home  »  Laravel   »   Laravel 7|8 PDF Tutorial: Generate PDF in Laravel with DOMPDF
Laravel 7|8 PDF Tutorial: Generate PDF in Laravel with DOMPDF
Last updated on September 14, 2020 by Digamber

Primis Player Placeholder



In this tutorial, we will discourse about the Laravel 7 Export to PDF topic. We will learn how to generate PDF from HTML using the DomPDF library.

This step by step tutorial allows you to explore the limitless opportunity if you are a newbie laravel developer. In general, PDF files are used to provide some information to the users.

It’s a format that assures a document that can be portrayed the same way, despite what software is used. All of the information required for presenting the document, identically, is installed in the file leaving your documents safe, accessible, and secure for the long term.


PDF is a portable document format and helps us providing the invoices, user manuals, eBooks, application forms, etc. We will understand from starting to finish about how to create a PDF file in Laravel.

We will construct a user list in a table view, and this table view will show the hold the dynamic user records fetched from the database. Lastly, we will see how to export the table view in PDF file format.


Table of Contents
Install Laravel Project
Install DomPDF Package
Configure DomPDF Package
Setting Up Model and Migrations
Generate Fake Data
Define Controller & Route
Display Users List
Export To PDF
Conclusion
Install Laravel Project
For Laravel 7 export to PDF demo example we require to download a fresh laravel app.

Run the command to induct fresh Laravel project.


composer create-project laravel/laravel laravel-pdf --prefer-dist
Bash
Head over to the project folder:

cd laravel-pdf
Bash
Install DomPDF Package in Laravel
In general, there are many other third-party packages available for HTML to PDF conversion in Laravel. I seldom use those packages, but the DomPDF package is a better choice, among others.


DOMPDF is a wrapper for Laravel, and It offers stalwart performance for HTML to PDF conversion in Laravel applications spontaneously.

Run the under-mentioned command to install DomPDF in Laravel 7.

composer require barryvdh/laravel-dompdf
Bash
Configure DomPDF Package in Laravel
Open config/app.php file and incorporate DomPDF service provider in providers array along with DomPDF facade to the aliases array.

'providers' => [
  Barryvdh\DomPDF\ServiceProvider::class,
],

'aliases' => [
  'PDF' => Barryvdh\DomPDF\Facade::class,
]
PHP
Execute the following command to publish the assets from vendor.

php artisan vendor:publish
Bash
A handful of packages list appeared on your terminal window, and we have to select the “Provider: Barryvdh\DomPDF\ServiceProvider” option from the list. It will create the new file config/dompdf.php, holding global configurations for the DomPDF plugin.

Ultimately, you can take the DomPDF in service to convert HTML to PDF File in Laravel using the following attribute.

use PDF;
PHP
Setting Up Model and Migrations
Create a new Model for Employee using the given below command.

php artisan make:model Employee -m
Bash
Open app/Employee.php file, and place the following code.

<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

    public $fillable = ['name', 'email', 'phone_number', 'dob'];

}
PHP
Open database/migrations/timestamp_create_employees_table.php and add the form values that we need to store in the database.

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
PHP
Execute the following command to migrate the database values, verify the table created with the values mentioned above in the MySQL database.

php artisan migrate
Bash
Generate Fake Data
We will create fake users list and show you how to generate PDF, to create fake data we need to use Faker package. It is a PHP library that generates fake data for you.

Head over to database/seeds/DatabaseSeeder.php and insert the following values that matches with your data table.

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    public function run() {
        $faker = Faker::create();

    	foreach (range(1,10) as $index) {
            DB::table('employees')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'dob' => $faker->date($format = 'D-m-y', $max = '2000',$min = '1990')
            ]);
        }
    }
}
PHP
Run command to generate the fake data.

php artisan db:seed
Bash
Check database table in PHPMyAdmin, you will see 10 new records have been generated for employees table.

Define Controller & Route
Please create a new controller, and It will have the logic to display the user’s list. Run the command to create the controller.

php artisan make:controller EmployeeController
Bash
Open app/Http/EmployeeController.php and add the following code.

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Employee;

class EmployeeController extends Controller
{
    public function showEmployees(){
      $employee = Employee::all();
      return view('index', compact('employee'));
    }
}
PHP
Define Route for Showing Employee List
Open routes/web.php and insert the following code. It will create relation between the controller and the view..

Route::get('/', 'EmployeeController@showEmployees');
PHP
Display Users List in Blade View Template
Generate a blade file resources/views/index.blade.php then insert the following code inside. The user records are fetched from database and being displayed in the laravel blade view temlpate using Bootstrap Table module.

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>

        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{ URL::to('#') }}">Export to PDF</a>
        </div>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">DOB</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee ?? '' as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone_number }}</td>
                    <td>{{ $data->dob }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
PHP
Generate PDF in Laravel with DOMPDF

Download PDF in Laravel
Now, we will learn how to export HTML to PDF and fetch users list from database and display in the PDF file format in Laravel.

Head over to app/Http/EmployeeController.php and define the createPDF() function. This function will fetch all the records from the database, share users data with PDF blade template and, allow downloading the PDF file.

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Employee;
use PDF;

class EmployeeController extends Controller {

    // Display user data in view
    public function showEmployees(){
      $employee = Employee::all();
      return view('index', compact('employee'));
    }

    // Generate PDF
    public function createPDF() {
      // retreive all records from db
      $data = Employee::all();

      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdf_view', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
}
PHP
Construct a new route in routes/web.php file; generically, it will handle the pdf download.

Route::get('/employee/pdf','EmployeeController@createPDF');
PHP
Create PDF Blade View Template
Create a new template file views/pdf_view.blade.php, insert the mentioned-below code inside of it.

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>Name</td>
        <td>Email</td>
        <td>Phone Number</td>
        <td>DOB</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($employee as $data)
        <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->phone_number }}</td>
            <td>{{ $data->dob }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
PHP
In the end, we have to add the following button above the table inside the index.blade.php. It will allow users to export HTML into PDF.

<a class="btn btn-primary" href="{{ URL::to('/employee/pdf') }}">Export to PDF</a>
PHP
Start Laravel Application
Run the below-mentioned command to run the Laravel PDF project.

php artisan serve
Bash
Explore app on http://127.0.0.1:8000

Conclusion
Ultimately, we have successfully connected every element to convert HTML into PDF. When the user clicks on the Export to PDF button, a pdf file will be downloaded. I reckon this tutorial will surely help you enhance your knowledge of Laravel development.

To better grasp, every fraction of this tutorial, download the full code of this tutorial from GitHub. Put a star on the repo if you think this tutorial helped you, thanks a lot in advance.


