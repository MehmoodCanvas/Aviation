


<!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>UnforgetAble Frames</span></strong>. All Rights Reserved
    </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('assets/admin/vendor/apexcharts/apexcharts.min.js')}}" defer></script>
  <script src="{{asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/chart.js/chart.umd.js')}}" defer></script>
  <script src="{{asset('assets/admin/vendor/echarts/echarts.min.js')}}" defer></script>
  <script src="{{asset('assets/admin/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/tinymce/tinymce.min.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('assets/admin/js/main.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/multi/image-uploader.min.js')}}"></script>
  <script>
const container = document.getElementById('sizeRowsContainer');
const addBtn = document.getElementById('addMoreSizeBtn');
const removeBtn = document.getElementById('removeLastSizeBtn');
const template = document.getElementById('sizeRowTemplate');

function updateRemoveBtn() {
    removeBtn.style.display = container.children.length > 1 ? '' : 'none';
}

addBtn.addEventListener('click', function () {
    const clone = template.cloneNode(true);
    clone.removeAttribute('id');
    clone.querySelectorAll('input').forEach(input => input.value = '');
    container.appendChild(clone);
    updateRemoveBtn();
});

removeBtn.addEventListener('click', function () {
    if (container.children.length > 1) {
        container.lastElementChild.remove();
        updateRemoveBtn();
    }
});

updateRemoveBtn();



  </script>
  <script>
        $('.input-images').imageUploader();
        $('.input-images2').imageUploader2();

   </script>

<script>
    function downloadpdf(){
      document.getElementsByClassName("download_btn")[0].innerHTML='Downloading...';
    var element = document.getElementById('invoice-print');
  var opt = {
  margin:       0,
  filename:     'invoice.pdf',
  image:        { type: 'jpeg', quality: 1 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};

html2pdf().set(opt).from(element).save().then(function () {
  document.getElementsByClassName("download_btn")[0].innerHTML = 'Completed';
}).catch(function (error) {
  document.getElementsByClassName("download_btn")[0].innerHTML = 'Error In Downloading Invoice, Please Reload';
});

    };

</script>
</body>

</html>