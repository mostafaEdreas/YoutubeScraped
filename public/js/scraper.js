var stop = false ;

$(document).ready(function() {
    
    $('#stopBtn').on('click' ,function () {
        stop =true ;
        $(this).prop('disabled', true).text('Stopping...');
    
    })
    $('#startBtn').on('click', async function() {
        stop = false ;
        $('#stopBtn').prop('disabled', false).text('Stop');
        const lines = $('#categoriesText').val().split('\n').filter(l => l.trim() !== "");
        if (lines.length === 0) return alert("أدخل تصنيفاً واحداً على الأقل");

        // UI Setup
        $('#dynamicPills').empty().append('<span class="filter-pill active" data-cat="all">الكل (0)</span>');
        $('#courseContainer').empty();

        // 1. Create all pills first
        lines.forEach(cat => {
            $('#dynamicPills').append(`<span class="filter-pill" data-cat="${cat.trim()}">${cat.trim()} (0)</span>`);
        });

        // 2. Loop through categories one by one
        for (const cat of lines) {
            if (stop) {
                  $('#stopBtn').prop('disabled', false).text('Stop');
                break; 
            }

            try {
                // Inside the loop
                const $currentPill = $(`.filter-pill[data-cat="${cat}"]`);
                $currentPill.addClass('loading'); // Add a CSS pulse or spinner
                
                await sendCategoryRequest(cat);
               
                $currentPill.removeClass('loading');
            } catch (error) {
                console.error(`Failed to process ${cat}:`, error);
            }
        }

        console.log("All categories finished!");
    });

    // Separate function to handle the AJAX promise
    function sendCategoryRequest(category) {
        return $.ajax({
            url: '/scraped-youtube',
            method: 'POST',
            contentType: 'application/json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: JSON.stringify({ category: category }), // Send only ONE category
            success: function(response) {
                console.log("Found " + response.count + " courses total.");
                 console.log( response);
                
                // Loop through the array returned by Laravel
                response.courses.forEach(course => {
                    appendCard(course);
                    updateCounts('all');
                    updateCounts(course.category);
                });
            }
        });
    }

    function appendCard(course) {
        const html = `
            <div class="col-md-3 course-item" data-category="${course.category}">
                <div class="card course-card h-100 position-relative">
                    <img src="${course.thumbnail}" class="card-img-top">
                    <span class="badge badge-lessons">15 درس</span>
                    <div class="card-body text-end">
                        <h6 class="fw-bold text-truncate">${course.title}</h6>
                        <p class="text-muted small">${course.channel_name}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-danger">${course.category}</span>
                            <span class="text-muted small">60K مشاهدة</span>
                        </div>
                    </div>
                </div>
            </div>`;
        $('#courseContainer').prepend(html);
    }

    function updateCounts(cat) {
        const $pill = $(`.filter-pill[data-cat="${cat}"]`);
        if ($pill.length) {
            let count = parseInt($pill.text().match(/\d+/)[0]) + 1;
            let label = (cat === 'all') ? 'الكل' : cat;
            $pill.text(`${label} (${count})`);
        }
    }

    // 4. Handle Pill Clicking (Filtering)
    $(document).on('click', '.filter-pill', function() {
        $('.filter-pill').removeClass('active');
        $(this).addClass('active');
        const cat = $(this).data('cat');

        if (cat === 'all') {
            $('.course-item').show();
        } else {
            $('.course-item').hide();
            $(`.course-item[data-category="${cat}"]`).show();
        }
    });
});