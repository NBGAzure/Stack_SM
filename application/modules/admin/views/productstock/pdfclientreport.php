<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
  <title>Resnbot User Product Report</title>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <div id="main-wrapper">
      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="card" style="width: 100%">
              <style>
                table {
                  width: 100%;
                  border-collapse: collapse;
                  border-spacing: 0;
                  margin-bottom: 20px;
                }

                table tr:nth-child(2n-1) td {
                  background: #F5F5F5;
                }

                
                table th {
                  padding: 5px 20px;
                  color: #5D6975;
                  border-bottom: 1px solid #C1CED9;
                  white-space: nowrap;        
                  font-weight: normal;
                }

                table .service,
                table .desc {
                  text-align: left;
                }

                table td {
                  padding: 20px;
                }

                table td.service,
                table td.desc {
                  vertical-align: top;
                }

                table td.unit,
                table td.qty{
                  font-size: 1.2em;
                }

                table td.grand {
                  border-top: 1px solid #5D6975;;
                }

                #project {
                  float: left;
                }

                #project span {
                  color: #5D6975;
                  text-align: right;
                  width: 52px;
                  margin-right: 10px;
                  display: inline-block;
                  font-size: 0.8em;
                }

                #company {
                  float: right;
                  text-align: right;
                }

                #project div,
                #company div {
                  white-space: nowrap;        
                }

                .clearfix:after {
                  content: "";
                  display: table;
                  clear: both;
                }
                table p{
                  font-size: 5px !important;
                }
                table#schedule_table {
                    text-align: left!important;
                    float: left!important;
                    display:  inline-table;
                    margin-bottom: 20px;
                }
                p { margin: 0; }
                h4.card-title {
                    margin-bottom: 20px !important;
                    padding-bottom: 40px;
                }
              </style>
                <div class="card-body">
                  <div class="col-sm-12" style="width: 100%">
                    <div style="text-align: center;">
                      <h4 class="card-title">RESNBOT REPORT</h4>
                    </div>
                  </div> 
                  
                  <div class="col-sm-12" style="width: 100%">
                    <table>
                      <div>
                        <h4 style="padding-top: 20px;">Service User Details</h4>
                      </div>
                      <thead>
                        <tr>
                          <th class="va-m">Sr.No</th>
                          <th class="va-m">Product</th>
                          <th class="va-m">Department</th>
                          <th class="va-m">Previous Quantity</th>
                          <th class="va-m">Quantity</th>  
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $i = 1;
                          if(!empty($pdf_data)){
                          foreach($pdf_data as $val){ 
                        ?>
                        <tr>
                          <td><span class="footable-toggle"></span><?php echo $i;?></td>
                          <td><?php echo $val['product_name'];?></td>
                          <td><?php echo $val['department_name'];?></td>
                          <td><?php echo $val['previous_quantity'];?></td>
                          <td><?php echo $val['quantity'];?></td>
                        </tr>
                       
                      
                      <?php $i++; } } ?>
                      </tbody>
                    </table>
                  
                  </div> 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>