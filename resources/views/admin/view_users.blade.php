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
            <th class="th_deg">ID</th>
              <th class="th_deg">Name</th>
              <th class="th_deg">Email</th>
              <th class="th_deg">Phone</th>
              <th class="th_deg">User Type</th>
              <th class="th_deg">Action</th>
             
          </tr>

   @foreach ( $data as $data )
  

          <tr>
              <td>{{$data->id}}</td>
              <td>{{$data->name}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->phonenumber}}</td>
              <td>{{$data->usertype}}</td>
              <td>
                <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{url('user_delete',$data->id)}}">Delete</a>
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