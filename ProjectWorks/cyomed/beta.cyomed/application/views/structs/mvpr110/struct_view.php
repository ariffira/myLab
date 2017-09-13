<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
  <head>

    <?php $this->load->view('partials/mvpr110/head_view'); ?>

  </head>

  <body class=" ">

    <div id="wrapper">

      <?php $this->load->view('partials/mvpr110/topnav_view'); ?>

      <?php $this->load->view('partials/mvpr110/mainnav_view'); ?>

      <div class="content">

        <div class="container">

            <div class="row">

              <div class="col-md-4 col-sm-5">

                <div class="portlet">

                  <h4 class="portlet-title">
                    <u>Daily Stats</u>
                  </h4>

                  <div class="portlet-body">                
                  
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, fugiat, dolores, laborum sit.</p>

                    <hr>
                    
                    <table class="table keyvalue-table">
                      <tbody>
                        <tr>
                          <td class="kv-key"><i class="fa fa-dollar kv-icon kv-icon-primary"></i> Revenue</td>
                          <td class="kv-value">$5,367 </td>
                        </tr>
                        <tr>
                          <td class="kv-key"><i class="fa fa-gift kv-icon kv-icon-secondary"></i> Total Sales</td>
                          <td class="kv-value">473 </td>
                        </tr>
                        <tr>
                          <td class="kv-key"><i class="fa fa-exchange kv-icon kv-icon-tertiary"></i>Referrals</td>
                          <td class="kv-value">78</td>
                        </tr>
                        <tr>
                          <td class="kv-key"><i class="fa fa-envelope-o kv-icon kv-icon-default"></i> Inquiries</td>
                          <td class="kv-value">39 </td>
                        </tr>
                      </tbody>
                    </table>

                  </div> <!-- /.portlet-body -->

                </div> <!-- /.portlet -->
                
              </div> <!-- /.col -->


              <div class="col-md-8 col-sm-7">
                <div class="portlet">

                  <h4 class="portlet-title">
                    <u>Monthly Traffic</u>
                  </h4>
                    
                  <div class="portlet-body">

                    <div id="line-chart" class="chart-holder-300"></div>
                  </div> <!-- /.portlet-body -->          

                </div> <!-- /.portlet -->

              </div> <!-- /.col -->

            </div> <!-- /.row -->

                

            <div class="row">

                <div class="col-md-5">

                  <div class="portlet">

                    <h4 class="portlet-title">
                      <u>Product Breakdown</u>
                    </h4>
                    
                    <div class="portlet-body">

                      <div id="pie-chart" class="chart-holder-250"></div>
                    </div> <!-- /.portlet-body -->
                    
                  </div> <!-- /.portlet -->

                </div> <!-- /.col -->

                <div class="col-md-3">

                  <div class="portlet">

                    <h4 class="portlet-title">
                      <u>Progress Stats</u>
                    </h4>

                    <div class="portlet-body">
                      
                      <div class="progress-stat">
                          
                        <div class="progress-stat-label">
                          % New Visits
                        </div>
                        
                        <div class="progress-stat-value">
                          77.7%
                        </div>
                        
                        <div class="progress progress-striped progress-sm active">
                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                            <span class="sr-only">77.74% Visit Rate</span>
                          </div>
                        </div> <!-- /.progress -->
                        
                      </div> <!-- /.progress-stat -->

                      <div class="progress-stat">
                          
                        <div class="progress-stat-label">
                          % Mobile Visitors
                        </div>
                        
                        <div class="progress-stat-value">
                          33.2%
                        </div>
                        
                        <div class="progress progress-striped progress-sm active">
                          <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                            <span class="sr-only">33% Mobile Visitors</span>
                          </div>
                        </div> <!-- /.progress -->
                        
                      </div> <!-- /.progress-stat -->

                      <div class="progress-stat">
                          
                        <div class="progress-stat-label">
                          Bounce Rate
                        </div>
                        
                        <div class="progress-stat-value">
                          42.7%
                        </div>
                        
                        <div class="progress progress-striped progress-sm active">
                          <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width: 42%">
                            <span class="sr-only">42.7% Bounce Rate</span>
                          </div>
                        </div> <!-- /.progress -->
                        
                      </div> <!-- /.progress-stat -->

                    </div> <!-- /.portlet-body -->

                  </div> <!-- /.portlet -->

              </div> <!-- /.col -->

              <div class="col-md-4">
                <div class="portlet">

                  <h4 class="portlet-title">
                    <u>Server Load</u>
                  </h4>

                  <div class="portlet-body">

                    <div id="auto-chart" class="chart-holder-200"></div>
                  </div> <!-- /.portlet-body -->

                </div> <!-- /.portlet -->
                
              </div> <!-- /.col -->

            </div> <!-- /.row -->

        </div> <!-- /.container -->

      </div> <!-- .content -->

    </div> <!-- /#wrapper -->

    <footer class="footer">
      <div class="container">
        <p class="pull-left">Copyright &copy; 2013 MVP Ready.</p>
      </div>
    </footer>


    <?php $this->load->view('partials/mvpr110/scripts_view'); ?>


  </body>
</html>