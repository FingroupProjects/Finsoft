<?php

namespace App\Enums;

enum DocumentHistoryStatuses :string
{
    case CREATED = 'Создан';

    case UPDATED = 'Изменен';

    case DELETED = 'Удален';

    case APPROVED = 'Проведен';

    case RESTORED = 'Восстановлен';

    case FORCE_DELETED = 'Очищен';


}
