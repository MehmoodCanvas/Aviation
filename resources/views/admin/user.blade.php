@include('admin.inc.header')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </nav>
    </div>

    <section>
    <a  class="btn btn-success" href="{{url('/admin/add-product')}}">Add New User</a>
      <table class="table datatable">
        <thead>
            <th>S.No</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Status</th>
            <th>User Role</th>
            <th>Action</th>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user->member_full_name}}</td>
            <td>{{$user->member_email}}</td>
            <td>{{$user->member_status}}</td>
            <td>{{$user->role_name}}</td>
            <td><a href='{{url('admin/user/edit/'.$user->member_id)}}' target='_blank' class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a></td>
          </tr>
          @endforeach
        </tbody>
    </table>
     
        </div><!-- End Left side columns -->

      
      </div>
    </section>

  </main>
  <!-- End #main -->
@include('admin.inc.footer')