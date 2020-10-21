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