
   <?php

    $urlArray =  explode('/', $_SERVER['PHP_SELF']);

    $ArrayCount = count($urlArray);

    $last = $urlArray[$ArrayCount - 1];
    $preLast = $urlArray[$ArrayCount - 2];


    if ($last == 'index.php' && $preLast == 'dashboard') {
        require 'helpers/closeConnection.php';
    } else {
        require '../helpers/closeConnection.php';
    }
    
   
   
   ?>     
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="http://localhost/fashion/dashboard/resources/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="http://localhost/fashion/dashboard/resources/assets/demo/chart-area-demo.js"></script>
<script src="http://localhost/fashion/dashboard/resources/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="http://localhost/fashion/dashboard/resources/assets/demo/datatables-demo.js"></script>
</body>

</html>