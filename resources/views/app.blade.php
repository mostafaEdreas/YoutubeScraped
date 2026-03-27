<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YouTube Course Scraper</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold">جمع الدورات التعليمية من يوتيوب</h1>
            <p class="opacity-75">أدخل التصنيفات واضغط ابدأ - النظام سيجمع الدورات تلقائياً باستخدام الذكاء الاصطناعي
            </p>
        </div>
    </div>

    <div class="container main-content">
        <div class="card input-card p-4 mb-5">
            <div class="row g-4 align-items-center">
                <div class="col-md-4">
                    <button id="startBtn" class="btn btn-collect w-100 mb-2">
                        <span>ابدأ الجمع</span>
                        <i class="bi bi-play-fill"></i>
                    </button>
                    <button id="stopBtn" class="btn btn-outline-secondary w-100">إيقاف</button>
                </div>
                <div class="col-md-8 text-end">
                    <label class="text-secondary small mb-2">أدخل التصنيفات (كل تصنيف في سطر جديد)</label>
                    <textarea id="categoriesText" class="form-control" rows="4" placeholder="التسويق&#10;البرمجة&#10;الجرافيكس"></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div id="dynamicPills" class="d-flex gap-2 flex-wrap">
            </div>
            <h4 class="fw-bold m-0">الدورات المكتشفة</h4>
        </div>

        <div class="row g-4" id="courseContainer">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/scraper.js') }}"></script>
</body>

</html>
