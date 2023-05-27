<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLES -->
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/main.css">
    
    <!-- PAGE-TITLE -->
    <title>Главная</title>
</head>
<body>
 
    <header class="main-header">
        <div class="container">
            <h1>{{$title}}</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Ваши файлы</h2>
            <a href="">Загрузить файл</a>
            <div class="horz-divider"></div>

            <div class="file-card">
                <img src="img/icons/icons8-archive-folder-100.png" alt="Проект.zip">
                <span>{{$name}}</span>
                <div class="menu">
                    <a href=""><img src="img/archive.png"></a>
                    <a href=""><img src="img/edit.png"></a>
                    <a href=""><img src="img/send-to-trash.png"></a>
                </div>
            </div>

            
        </div>
    </main>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <!--Подключаем Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>

    <script>
        let vm = new Vue({
            el: '#app',
            data: {
                files: [],
            },
            methods: {
                loadFileList(){
                    axios.get('http://127.0.0.1:8000/api/file/all')
                    .then((response) => {
                        this.files = response.data;
                    });
                },
                addFile(){
                    
                },
                deleteFile(id){
                    axios.get('http://127.0.0.1:8000/api/file/delete' + id)
                    .then((response) => {
                        console.log(response);
                    });
                },
            },
            mounted(){
                // Сразу после загрузки страницы подгружаем список книг и отображаем его
                this.loadFileList();
            }
        });
    </script>
</body>
</html>