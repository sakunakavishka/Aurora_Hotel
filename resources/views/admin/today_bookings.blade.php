<!DOCTYPE html>
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
    padding: 5px;
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
                <th class="th_deg">Cheack Out</th>
                <th class="th_deg">Status Update</th>
                
            </tr>

    
            @foreach ($data as $data)
            
                @if ($data->start_date === Carbon\Carbon::now()->format('Y-m-d'))
                   
               

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
                    <a onClick="return confirm('Are you sure to delete this');" class="btn btn-danger" href="{{url('delete_booking',$data->id)}}">Cheack Out</a>
                </td>
                <td>
                    <span style="padding-bottom:10px ">
                    <a class="btn btn-success" href="{{url('approve_book',$data->id)}}">Approve</a>
                    </span>
                    <a class="btn btn-warning" href="{{url('reject_book',$data->id)}}">Rejected</a>
                </td>
            </tr>
            @endif
            @endforeach
         
        </table>

      </div>
    </div>
   </div>

       @include('admin.footer')




  </body>
</html>