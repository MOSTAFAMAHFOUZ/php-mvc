

<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <?php if(session('success')): ?>
                <div class="alert alert-success text-center">
                    <?php echo flash('success') ?>
                </div>
            <?php endif; ?>
            <table class="table table-primary my-5 table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>category name</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>

                <tbody>
                <?php $i=1; foreach($data as $row): ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row->cat_name; ?></td>
                        <td>
                            <a href="<?php echo url('category/edit/'.$row->cat_id); ?>" class="btn btn-info">
                                Edit
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo url('category/delete/'.$row->cat_id); ?>" class="btn btn-danger">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>



