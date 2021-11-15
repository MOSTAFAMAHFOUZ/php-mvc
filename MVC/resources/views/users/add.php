<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php if(session('errors')): ?>
                <?php foreach(flash('errors') as $error): ?>
                <div class="alert alert-danger text-center">
                    <?= $error; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="<?= url('user/store'); ?>" method="POST" class="my-5 border p-3">
                <div class="mb-3">
                    <label for="name">User Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">User Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password">User Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit"  class="btn btn-block btn-primary" value="send">
                </div>
            </form>
        </div>
    </div>
</div>