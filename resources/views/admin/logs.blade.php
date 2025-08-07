@include('admin.inc.header')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>All Logs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Logs</li>
        </ol>
      </nav>
    </div>

    <section >
      <table class="table datatable">
        <thead>
            <th>Logs.No</th>
            <th>Log</th>
            <th>Submitted to</th>
            <th>Submitted By</th>
            <th>Action</th>
        </thead>
        <tbody>
          <tr>
            {{-- <td> {{$orders->order_invoice_id}}</td>
            <td> {{$orders->order_invoice_id}}</td>
            <td> {{$orders->order_invoice_id}}</td>
            <td> {{$orders->order_invoice_id}}</td>
            <td><a href='{{url('admin/order-detail/'.$orders->order_id)}}' class="btn btn-success"><i class="bi bi-eye"></i></a><button class="btn btn-danger"><i class="bi bi-archive"></i></button></td> --}}
          </tr>
        </tbody>
    </table>
     
        </div><!-- End Left side columns -->

      
      </div>
    </section>

  </main><!-- End #main -->
@include('admin.inc.footer')