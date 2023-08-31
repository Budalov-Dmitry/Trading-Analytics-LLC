<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Тестовое задание, вакансия PHP-fullstack разработчик</title>
</head>
<body>

<button class="import" type="submit">импортировать пользователей</button>
<div class="result"></div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const elem = document.querySelector(".import");
        elem.addEventListener('click', function()
        {
            if (confirm("Получить данные?"))
            {
                send('/api/import')
                    .then((response) =>
                {
                    const result = document.querySelector('.result');

                    result.innerHTML = `Всего:<span>${response.total}</span>
                        Добавлено:<span>${response.added}</span>
                        Обновлено:<span>${response.renew}</span>`;

                }).catch((e) =>
                {
                    console.log(
                        "There has been a problem with your fetch operation: " + e.message,
                    );
                });
            }
        });
    });
    async function send(url)
    {
        let response = await fetch(url,
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
        return await response.json();
    }
</script>
</body>
</html>


