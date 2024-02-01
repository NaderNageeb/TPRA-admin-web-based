
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="include/logout.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
   

        <div class="container my-auto py-2">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - distributed by
              <b><a href="">Future University</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="include/vendor/jquery/jquery.min.js"></script>
  <script src="include/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="include/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="include/js/ruang-admin.min.js"></script>
  <script src="include/vendor/chart.js/Chart.min.js"></script>
  <script src="include/js/demo/chart-area-demo.js"></script>  
   
  <!-- Page level plugins -->
  <script src="include/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="include/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

<!-- reports page show Data in model function -->

<script>
$(document).on("click",".view",function(){
var post_id = $(this).data('id');
var report_id = $(this).data('repid');
// alert(report_id);
$.ajax({

  type:"post",
  data:{post_id:post_id,report_id:report_id},
  url:"get_details.php",
  dataType:"text",
  success:function(responce){
   $(".modal-body").html(responce);
  },
  error:function(request , status , error){
    $(".modal-body").html(request.responceText);

  }

});
});

</script>

</body>

</html>