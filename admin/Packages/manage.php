<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from packages where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New " ?>Create Package</h3>
	</div>
	<div class="card-body">
		<form action="" id="package-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group">
				<label for="title" class="control-label">Package Title</label>
                <textarea name="title" id="" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($title) ? $title : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="tour_location" class="control-label">Tour Location</label>
                <textarea name="tour_location" id="" cols="30" rows="2" class="form-control form no-resize"><?php echo isset($tour_location) ? $tour_location : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="cost" class="control-label">Price</label>
                <input type="number" step="any" class="form form-control" name="cost" value="<?php echo isset($cost) ? $cost : 0; ?>">
			</div>
            <div class="form-group">
				<label for="description" class="control-label">Description</label>
                <textarea name="description" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo isset($description) ? $description : ''; ?></textarea>
			</div>
            <div class="form-group">
				<label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom-select selevt">
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
			</div>
            <div class="form-group">
				<label for="" class="control-label">Images</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img[]" multiple accept="image/*" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
            <?php if(isset($upload_path) && is_dir(base_app.$upload_path)): ?>
            <?php 
        
            $file= scandir(base_app.$upload_path);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;
                    
                
            ?>
                <div class="d-flex w-100 align-items-center img-item">
                    <span><img src="<?php echo base_url.$upload_path.'/'.$img ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                    <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
			
		</form>