<?php
$title = "Edit Fee Category Amount";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
        <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Update Fee Category Amounts</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Update Fee Category Amounts</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>

        <div class="container-fluid">
            <?php
                echo notification();
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark">
	    					<h5 class="card-title">Fee Category Amount</h5>
	    					<a href="fee_category_amount.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
                        <div class="card-body">
                            <?php
                                $query = "SELECT * FROM fee_categories";
                                $query_run = mysqli_query($conn,$query);
                                $categories = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

                                $class_query = "SELECT * FROM classes";
                                $class_query_run = mysqli_query($conn,$class_query);
                                $classes = mysqli_fetch_all($class_query_run,MYSQLI_ASSOC);

                                if(isset($_GET['fee_category_id'])){
                                    $fee_category_id = $_GET['fee_category_id'];
                                    
                                    $amounts_query = "SELECT * FROM fee_category_amounts WHERE fee_category_id='$fee_category_id' ORDER BY class_id ASC";
                                    $amounts_query_run = mysqli_query($conn,$amounts_query);
                                    $amounts = mysqli_fetch_all($amounts_query_run,MYSQLI_ASSOC);
                                }
                            ?>
                            <form action="fee_category_amount_code.php" method="POST">
                                <div class="col-12">
                                    <div id="main-item">
                                        <div class="form-group row">
                                            <label class="col-form-label" style="width: 100px;">Fee Category :</label>
                                            <div class="col-4">
                                            <select name="fee_category_id" class="form-control">
                                                <option value="">Select Fee</option>
                                                <?php
                                                    foreach ($categories as $key => $category) {
                                                        ?>
                                                            <option value="<?php echo $category['id'];?>"<?php echo ($amounts['0']['fee_category_id'] == $category['id']) ? "selected":""?>><?php echo $category['name'];?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <?php
                                            foreach ($amounts as $key => $amount) {
                                                ?>
                                                <div class="remove-additional-element">
                                                    <div class="form-group row">
                                                    <label class="col-form-label" style="width: 100px;">Class :</label>
                                                    <div class="col-4">
                                                    <select name="class_id[]" class="form-control">
                                                        <option value="">Select Class</option>
                                                            <?php
                                                                foreach ($classes as $key => $class) {
                                                                ?>
                                                                    <option value="<?php echo $class['id']; ?>" <?php echo ($amount['class_id'] == $class['id']) ? "selected" : ""; ?>><?php echo $class['name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                    </select>
                                            
                                                    </div>
                                                    </div>
                                                    <div class="from-group row">
                                                    <label class="col-form-label" for="" style="width: 100px;">Fee Amount :</label>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="amount[]" value="<?php echo $amount['amount']; ?>"><br>
                
                                                    </div>
                                                     <div>
                                                     <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i></button>
                                                     <button type="button" class="btn btn-danger remove-btn" style="margin-left: 5px;"><i class="fa fa-minus"></i></button>
                                                     </div>       
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="btn-update">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div>
    <div class="d-none" id="additional-element">
        <div class="remove-additional-element">
            <div class="form-group row">
                <label class="col-form-label" for="" style="width: 100px;">Class :</label>
                    <div class="col-md-4">
                        <select name="class_id[]" class="form-control">
                            <option value="">Select Class</option>
                                <?php
                                    foreach ($classes as $key => $class) {
                                    ?>
                                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                    <?php
                                }
                                ?>
                        </select>
                    </div>      
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="" style="width: 100px;">Fee Amount :</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="amount[]">
                </div>
                                   
                <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-danger remove-btn" style="margin-left: 5px;"><i class="fa fa-minus"></i></button>      
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click','.add-btn',function(){
            let html = $('#additional-element').html();
            $('#main-item').append(html);
        });
        $(document).on('click','.remove-btn',function(){
            $(this).closest('.remove-additional-element').remove();
        });
    });
</script>
<?php
include('includes/footer.php');
include('includes/script.php');
?>