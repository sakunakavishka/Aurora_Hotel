<!DOCTYPE html>
<html>
  <head> 
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
     padding: 15px;
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
                <th class="th_deg">Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Phone</th>
                <th class="th_deg">Message</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Send Email</th>
               
            </tr>

     @foreach ( $data as $data )
    

            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->message}}</td>
                <td>
                  <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{url('message_delete',$data->id)}}">Delete</a>
                </td>
                <td>
                  <a class="btn btn-success" href="{{url('send_mail',$data->id)}}">Send mail</a>
                </td>

                
                
            </tr>

            @endforeach

        </table>

      </div>
    </div>
</div>

       @include('admin.footer')




  </body>
</html>