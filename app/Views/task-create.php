<div class="col-12">
    <form action="/task/store" method="post">
        <div class="form-group row">
            <label>Имя пользователя</label>
            <input type="text" name="fio" class="form-control" value="<?= old('fio') ?? '' ?>">
            <div>
                <span class="error"><?= get_error('fio') ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label>E-mail</label>
            <input type="text" name="email" value="<?= old('email') ?? '' ?>" class="form-control">
            <div>
                <span class="error"><?= get_error('email') ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label>Текст задачи</label>
            <textarea name="body" rows="6" class="form-control"><?= old('body') ?? '' ?></textarea>
            <div>
                <span class="error"><?= get_error('body') ?></span>
            </div>
        </div>
        <div class="form-group row">
            <input type="submit" class="btn btn-primary" value="Сохранить">  &nbsp;&nbsp;&nbsp;
            <a type="button" class="btn btn-primary" href="/main/index">Назад</a>
        </div>
    </form>
</div>
<style>
    .error {
        color: red;
        font-size: 1em;
    }
</style>
