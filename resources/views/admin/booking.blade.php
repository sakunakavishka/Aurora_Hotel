{{-- <!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
   @include('admin.css')
   <style type="text/css">
    .table_deg
   { 
    border: 2px solid white;
    margin:auto ;
    width: 80%;
    text-align: center;
    margin-top: 40px;
   }
   .th_deg
   {
    background-color: skyblue;
    padding: 10px;
   }
   tr
   {
    border:3px solid white;
   }
   td
   {
    padding: 10px;
   }
    </style>
  </head>
  <body>
    @include('admin.header')
   @include('admin.sidebar')
        

   <div class="page-content">
    <div class="page-header">
      <div class="container-fluid"> 


        <table class ="table_deg">
            <tr>
                <th class="th_deg">Room ID</th>
                <th class="th_deg">Customer Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Phone</th>
                <th class="th_deg">Room Count</th>
                <th class="th_deg">Arrival Date</th>
                <th class="th_deg">Leaveing Date</th>
                <th class="th_deg">Status</th>
                <th class="th_deg">Room Title</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Status Update</th>
                <th class="th_deg">Send Email</th>
                
            </tr>

    
            @foreach ($data as $data)
                

            <tr>
                <td>{{$data->room_id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->room_count}}</td>
                <td>{{$data->start_date}}</td>
                <td>{{$data->end_date}}</td>
            <td>
                @if ($data->status == 'approve')
                <span style="color: skyblue;">Approve</span> 
                @endif

                @if ($data->status == 'rejected')
                <span style="color: red;">Rejected</span> 
                @endif

                @if ($data->status == 'waiting')
                <span style="color: yellow;">Waiting</span> 
                @endif
            </td>
                
                <td>{{$data->room->room_title}}</td>
                <td>{{$data->room->price}}</td>
                <td>
                    <img style="width: 200!important" src="room/{{$data->room->image}}">
                </td>
                <td>
                    <a onClick="return confirm('Are you sure to delete this');" class="btn btn-danger" href="{{url('delete_booking',$data->id)}}">Delete</a>
                </td>
                <td>
                    <span style="padding-bottom:10px ">
                    <a class="btn btn-success" href="{{url('approve_book',$data->id)}}">Approve</a>
                    </span>
                    <a class="btn btn-warning" href="{{url('reject_book',$data->id)}}">Rejected</a>
                </td>
                <td>
                    <a class="btn btn-info" href="{{ url('send_email_form', $data->id) }}">Send Email</a>
                  </td>
    
            </tr>
            @endforeach
         
        </table>

      </div>
    </div>
   </div>

       @include('admin.footer')




  </body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

    <style type="text/css">
        .table_deg {
            border: 2px solid white;
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 40px;
            color: black; /* Make the text color black */
        }
        .th_deg {
            background-color: skyblue;
            padding: 10px;
        }
        tr {
            border: 3px solid white;
        }
        td {
            padding: 10px;
            color: black; /* Ensure table data text is black */
        }
        tbody {
            background-color: black; /* Make the table body background black */
        }
        .dataTables_filter input {
            background-color: white;
            color: black; /* Ensure search input text is black */
            border: 1px solid #ccc;
            padding: 5px;
        }
        .dataTables_filter label {
            color: white;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important; /* Change pagination button text color to white */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important; /* Keep the hover color white */
        }
        /* Custom CSS for DataTables buttons */
        .dt-buttons .dt-button {
            background-color: #007bff;
            color: white !important; /* Make button text white */
            border: none;
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
        }
        .dt-buttons .dt-button:hover {
            background-color: #0056b3;
            color: white !important; /* Keep button text white on hover */
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <table id="bookingTable" class="table_deg">
                    <thead>
                        <tr>
                            <th class="th_deg">Room ID</th>
                            <th class="th_deg">Customer Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Room Count</th>
                            <th class="th_deg">Arrival Date</th>
                            <th class="th_deg">Leaving Date</th>
                            <th class="th_deg">Status</th>
                            <th class="th_deg">Room Title</th>
                            <th class="th_deg">Price</th>
                            <th class="th_deg">Image</th>
                            <th class="th_deg">Delete</th>
                            <th class="th_deg">Status Update</th>
                            <th class="th_deg">Send Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{$data->room_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->room_count}}</td>
                                <td>{{$data->start_date}}</td>
                                <td>{{$data->end_date}}</td>
                                <td>
                                    @if ($data->status == 'approve')
                                        <span style="color: #59DF08;">Approve</span>
                                    @endif
                                    @if ($data->status == 'rejected')
                                        <span style="color: red;">Rejected</span>
                                    @endif
                                    @if ($data->status == 'waiting')
                                        <span style="color: #F1C40F;">Waiting</span>
                                    @endif
                                </td>
                                <td>{{$data->room->room_title}}</td>
                                <td>{{$data->room->price}}</td>
                                <td>
                                    <img style="width: 200px !important" src="room/{{$data->room->image}}">
                                </td>
                                <td>
                                    <a onClick="return confirm('Are you sure to delete this');" class="btn btn-danger" href="{{url('delete_booking',$data->id)}}">Delete</a>
                                </td>
                                <td>
                                    <span style="padding-bottom: 10px;">
                                        <a class="btn btn-success" href="{{url('approve_book',$data->id)}}">Approve</a>
                                    </span>
                                    <a class="btn btn-warning" href="{{url('reject_book',$data->id)}}">Rejected</a>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ url('send_email_form', $data->id) }}">Send Email</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookingTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
</html>
