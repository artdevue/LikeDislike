<?php
/**
 * Default Russian Lexicon Entries for likeDislike
 *
 * @package likedislike
 * @subpackage lexicon
 * lang ru
 */
$_lang['likedislik'] = 'LikeDislik';
$_lang['likedislike'] = 'LikeDislike';
$_lang['likedislike.home'] = 'Главная';
$_lang['likedislike.ip_block'] = 'Блокированные IP адреса';
$_lang['likedislike.desc'] = 'Управляйте голосованиями за все, что угодно на вашем сайте.';
$_lang['likedislike.description'] = 'Описание';
$_lang['likedislike.likedislik_err_ae'] = 'LikeDislik с таким именем уже существует.';
$_lang['likedislike.likedislik_err_nf'] = 'Не найдено значения.';
$_lang['likedislike.likedislik_err_ns'] = 'Не указано значения.';
$_lang['likedislike.likedislik_err_ns_multiple'] = 'Ничего не выбранно.';
$_lang['likedislike.likedislik_err_ns_name'] = 'Пожалуйста, укажите имя LikeDislik.';
$_lang['likedislike.likedislik_err_ip_name'] = 'Пожалуйста, укажите IP-адрес.';
$_lang['likedislike.likedislik_err_remove'] = 'Произошла ошибка при попытке удалить LikeDislik.';
$_lang['likedislike.likedislik_err_save'] = 'Произошла ошибка при попытке сохранить LikeDislik.';
$_lang['likedislike.likedislik_err_data'] = 'Неверные данные.';
$_lang['likedislike.likedislik_err_ip_blocked'] = 'Вы уже голосовали.';
$_lang['likedislike.likedislik_err_invalid_id'] = 'Этот элемент голосования уже больше не существует.';
$_lang['likedislike.likedislik_err_closed'] = 'Голосование было закрыто для данного элемента.';
$_lang['likedislike.likedislik_err_login_required'] = 'Авторизуйтесь, чтобы голосовать.';
$_lang['likedislike.likedislik_create'] = 'Создать новый LikeDislik';
$_lang['likedislike.ip_create'] = 'Добавить новый IP адрес';
$_lang['likedislike.likedislik_remove'] = 'Удалить likeDislik';
$_lang['likedislike.likedislik_remove_ip'] = 'Удалить IP адрес';
$_lang['likedislike.likedislik_remove_ips'] = 'Удалить выбранные IP адреса';
$_lang['likedislike.likedislik_remove_confirm'] = 'Вы действительно хотите удалить этот LikeDislik?';
$_lang['likedislike.likedislik_remove_ip_confirm'] = 'Вы действительно хотите удалить этот IP-адрес?';
$_lang['likedislike.likedislik_remove_ips_confirm'] = 'Вы уверены, что хотите удалить выбранные IP-адреса?';
$_lang['likedislike.likedislik_update'] = 'Обновить LikeDislik';
$_lang['likedislike.downloads'] = 'Скачать';
$_lang['likedislike.location'] = 'Местонахождение';
$_lang['likedislike.category_select'] = 'Категория';
$_lang['likedislike.all_category'] = 'Все категории';
$_lang['likedislike.management'] = 'Управление LikeDislike';
$_lang['likedislike.management_desc'] = 'Управляйте голосованиями за все, что угодно на вашем сайте. Вы можете редактировать результаты голосований (столбцы "Да" и "Нет") дважды щелкнув в сетке на соотвутствующую ячейку. Снизу даты публикации, указана <strong>категория</strong> (по умолчанию &mdash; class key resource) и через косую "/" &mdash; <strong>likeId</strong> (по умолчанию &mdash; id ресурса).'; 
$_lang['likedislike.management_ip_desc'] = 'Управление IP-блокировками. Список IP-адресов, которые заблокированы. Это означает, что они не могут голосовать. <br/> * Примечание. Вы можете настроить шаблоны с помощью символа *. --- Пример: заблокировать все IP-адреса, которые начинаются с "123.123.123.*"';
$_lang['likedislike.likedislik_err_ap_adress'] = 'Неверный IP адрес';
$_lang['likedislike.name'] = 'Название';
$_lang['likedislike.date'] = 'Дата';
$_lang['likedislike.search...'] = 'Поиск&hellip;';
$_lang['likedislike.ip_adress'] = 'IP адрес';
$_lang['likedislike.ip_block_create'] = 'Добавить IP';
$_lang['likedislike.loading'] = '<div class="centered empty-msg">Загрузка&hellip;</div>';
$_lang['likedislike.items_empty_msg'] = '<h4>Нет записей, удовлетворяющих вашим критериям поиска</h4><p>Или вы еще не создали ни одного LikeDislike, или никто не открыл ресурс, содержащий LikeDislike</p>';
$_lang['likedislike.items_empty_ip_msg'] = '<h4>Нет записей, удовлетворяющих вашим критериям поиска</h4><p>Или добавьте новый IP адрес, нажав на зелёную кнопку "Добавить IP"</p>';

$_lang['setting_likedislike.defaultTemplate'] = 'Шаблон по умолчанию';
$_lang['setting_likedislike.defaultTemplate_desc'] = 'Формат по умолчанию будет использоваться для каждого шаблона.<br/>См. <a href="http://like.artdevue.com/ru/">документацию</a> для более подробного объяснения.';
$_lang['setting_likedislike.cookieCheck'] = 'Проверка Cookie';
$_lang['setting_likedislike.cookieCheck_desc'] = 'Включить или отключить проверку куки, когда пользователь голосует. Если в куки записался идентификатор пункта, пользователь не сможет проголосовать за него снова <br /> Примечание. Отключение проверки куки, будет отключать любые куки для LikeDislike <br/> // Да или Нет';
$_lang['setting_likedislike.cookieName'] = 'Название Cookie';
$_lang['setting_likedislike.cookieName_desc'] = 'Имя куки для LikeDislike.';
$_lang['setting_likedislike.cookieLifetime'] = 'Срок хранения куки';
$_lang['setting_likedislike.cookieLifetime_desc'] = 'Срок хранения куки. Другими словами, количество секунд хранения куки после последнего голосования до срока истекания куки <br/> Если установлено в 0, куки истекает, когда браузер закрывается. <br/> Пример: 3600 * 24 * 365 // 1 год';
$_lang['setting_likedislike.cookiePath'] = 'Патч Cookie';
$_lang['setting_likedislike.cookiePath_desc'] = 'Путь на сервере, по которому куки будут доступны.<br/> Если установлено в "/", куки будут доступны для всего домена<br/>. См.: <a target="_blank" href="http://php.net/manual/function.setcookie.php">http://php.net/manual/function.setcookie.php</a>';
$_lang['setting_likedislike.cookieDomain'] = 'Имя домена Cookie';
$_lang['setting_likedislike.cookieDomain_desc'] = 'Имя домена для куки. Вы можете установить куки, которые доступны для поддоменов, если вам это нужно. Пример: ".yoursite.com"<br/> См.: <a target="_blank" href="http://php.net/manual/function.setcookie.php">http://php.net/manual/function.setcookie.php</a>';
$_lang['setting_likedislike.ipCheck'] = 'Проверка IP';
$_lang['setting_likedislike.ipCheck_desc'] = 'Включить или отключить проверку IP, когда пользователь голосует. Если голосования для элемента было с того же IP, пользователь не сможет проголосовать за него снова<br/>. Примечание: отключая эту проверку, не сохраняются IP-адреса для голосование.';
$_lang['setting_likedislike.ipLifetime'] = 'Срок хранения IP';
$_lang['setting_likedislike.ipLifetime_desc'] = 'Срок храрнения IP-адреса. Время в секундах, когда пользователь с одного и того же IP-адреса может голосовать для пункта LikeDislike.<br/> Если установлено в 0, IP-адреса будут храниться вечно.';
$_lang['setting_likedislike.userIdCheck'] = 'Проверка id пользователя';
$_lang['setting_likedislike.userIdCheck_desc'] = 'Включение или отключение проверки идентификатора пользователя, когда пользователь голосует. Это позволит предотвратить зарегистрированным пользователям проголосовать несколько раз, независимо от того, включины куки и проверка по IP-адресу. <br/> Примечание: эта проверка не мешает гостям голосовать, если не установите параметр user_login_required значение ДА.';
$_lang['setting_likedislike.userLoginRequired'] = 'Только зарегестрированные';
$_lang['setting_likedislike.userLoginRequired_desc'] = 'Если установлено значение "ДА", пользователь должен авторизоваться на сайте, чтобы голосовать.<br/> Гости не смогут участвовать в голосовании.';

$_lang['likedislike.like_selected_publish'] = 'Опубликовать выбранные';
$_lang['likedislike.like_selected_unpublish'] = 'Отменить публикацию';
$_lang['likedislike.like_selected_delete'] = 'Удалить выбранные';
$_lang['likedislike.like'] = 'нравится';
$_lang['likedislike.voting_closed'] = 'голосование<br/>закрыто';
$_lang['likedislike.thanks_vote'] = 'спасибо<br/>за ваш голос';
$_lang['likedislike.question'] = 'А вам?';
$_lang['likedislike.out_of'] = 'из';
$_lang['likedislike.people_like_this'] = 'человек нравится это.';
$_lang['likedislike.like_err_ns_multiple'] = 'Пожалуйста, выберите хотя бы один LikeDislike. ';
$_lang['likedislike.year'] = 'год';
$_lang['likedislike.open'] = 'Открыто';
$_lang['likedislike.category'] = 'Категория';
$_lang['likedislike.date_pub'] = 'Дата публикации';
$_lang['likedislike.up'] = 'Да';
$_lang['likedislike.down'] = 'Нет';
$_lang['likedislike.total'] = 'Всего';
$_lang['likedislike.balance'] = 'Баланс';