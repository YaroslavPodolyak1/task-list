<div class="row justify-content-center">
    <div class="col-6">
        <form action="/auth/authorize" method="post">
            <div class="form-group row">
                <label>Логин</label>
                <input type="text" name="login" value="<?= old('login') ?? '' ?>" class="form-control">
                <div>
                    <span class="error"><?= get_error('login') ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label>Пароль</label>
                <input type="password" name="password" value="<?= old('password') ?? '' ?>"  class="form-control">
                <div>
                    <span class="error"><?= get_error('password') ?></span>
                </div>
            </div>
            <div class="form-group row">
                <input type="submit" class="btn btn-primary" value="Войти">
            </div>
        </form>
    </div>
</div>
<style>
    .error {
        color: red;
        font-size: 1em;
    }
</style>
