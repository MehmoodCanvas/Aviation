@include('admin.inc.header')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </nav>
    </div>

    <section>
    <a  class="btn btn-success" href="{{url('/admin/add-product')}}">Add New Product</a>
      <table class="table datatable">
        <thead>
            <th>S.No</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Action</th>
        </thead>
        <tbody>
          @foreach($product as $products)
          <tr>
            <td>{{$products->product_id}}</td>
            <td>{{$products->product_name}}</td>
            <td>${{$products->product_price}}</td>
            <td><img src="{{asset('storage/product/'.$products->product_image)}}" class="img-fluid" alt="{{$products->product_name}}"></td>
            <td><a href='{{url('admin/product-edit/'.$products->product_id)}}' target='_blank' class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a><a  href='{{url('admin/product-delete/'.$products->product_id)}}' class="btn btn-danger"><i class="bi bi-archive"></i></a></td>
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