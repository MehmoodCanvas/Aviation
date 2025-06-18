@include('admin.inc.header')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Films</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Films</li>
      </ol>
    </nav>
  </div>

  <section>
  <a  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#filmsmodals">Update Video</a>
  @if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
  @endif
    <table class="table datatable">
      <thead>
          <th>S.No</th>
          <th>Film Media</th>
          <th>Action</th>
      </thead>
      <tbody>
        @foreach($videos as $gal)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>
            <video preload="metadeta" src="{{asset('storage/films/'.$gal->video_media)}}" controls></video>
        </td>
        <td><a href='{{ url('admin/delete-video/'.$gal->video_id.'?filename='.$gal->video_media) }}' class="btn btn-danger"><i class="bi bi-archive"></i></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
   
      </div>
      <!-- End Left side columns -->

    
    </div>
  </section>

</main>



  
  <!-- End #main -->
@include('admin.inc.footer')    