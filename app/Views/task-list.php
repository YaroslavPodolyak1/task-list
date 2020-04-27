<div class="row">
    <div class="row col-12">
        <a class="btn btn-default" href="/task/create">Добавить задачу</a>
    </div>
    <? if (get_response_message()): ?>
        <div class="alert alert-success text-center text-dark col-12">
            <?= get_response_message() ?>
        </div>
    <? endif; ?>
    <?
    $_GET['sort'] ? $_GET['sort'] == 'asc' ? $sort = 'desc' : $sort = 'asc' : $sort = 'asc';
    $_GET['field'] ? $field = $_GET['field'] : $field = 'id';
    ?>
    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center">
            <th class="align-middle"><a href="/main/index?page=1&&field=fio&&sort=<?= $sort ?>">Имя пользователя</a></th>
            <th class="align-middle"><a href="/main/index?page=1&&field=email&&sort=<?= $sort ?>">е-mail</a></th>
            <th class="align-middle"><a href="javascript::void(0)">Текст задачи</a></th>
            <th class="align-middle"><a href="/main/index?page=1&&field=completed&&sort=<?= $sort ?>">Статус</a></th>
            <? if (auth()->check() && auth()->hasRole(1)): ?>
                <th class="align-middle">Действия</th>
            <? endif; ?>
            </thead>
            <tbody>
            <? if (! empty($params['tasks'])): ?>
                <? foreach ($params['tasks'] as $task) : ?>
                    <tr>
                        <td><?= $task->fio ?></td>
                        <td><?= $task->email ?></td>
                        <td><?= $task->body ?></td>
                        <td style="min-width: 200px">
                            <form action="/task/changeStatus" id="change-status-form-<?= $task->id ?>" method="post">
                                <input type="hidden" name="id" value="<?= $task->id ?>">
                                <label><input type="checkbox" id="completed-<?= $task->id ?>" onclick="changeStatus(<?= $task->id ?>)"
                                              name="completed" <? $task->completed ? print 'checked disabled' : '' ?> value="1">
                                    Выполнено</label>
                            </form>
                            <?= $task->edited ? ' отредактировано администратором' : '' ?>
                        </td>
                        <? if (auth()->check() && auth()->hasRole(1)): ?>
                            <td><a class="btn btn-default" href="/task/edit/?task=<?= $task->id ?>">Редактировать</a></td>
                        <? endif; ?>
                    </tr>
                <? endforeach; ?>
            <? endif; ?>
            </tbody>
        </table>
        <div class="row col-12">
            <ul class="pagination">
                <? for ($i = 1; $i <= $totalCount; $i ++): ?>
                    <li class="page-item <? $i == $currentPage ? print 'active' : '' ?>">
                        <a class="page-link" href="/main/index?page=<?= $i ?>&&field=<?= $field ?>&&sort=<?= $_GET['sort'] ?>""><?= $i ?></a>
                    </li>
                <? endfor; ?>
            </ul>
        </div>
    </div>
</div>
<script>
    $(function () {
        setTimeout(function () {
            <?if ($_SESSION['data']['message']) {
            unset($_SESSION['data']['message']);
        }?>
        }, 3000)
    })
    const changeStatus = (taskId) => {
        $(`#change-status-form-${ taskId }`).submit();
    }

</script>