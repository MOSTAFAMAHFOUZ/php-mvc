<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <form action="<?= url('category/update/'.$data->cat_id); ?>" method="POST" class="my-5 border p-3">
                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" value="<?= $data->cat_name;?>" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit"  class="btn btn-block btn-primary" value="send">
                </div>
            </form>
        </div>
    </div>
</div>