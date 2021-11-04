let duration = $('#exam_duration').val();
let timeOfExam = duration * 60;
let displayCounter = document.getElementById('countDownTimer');
setInterval(updateCounter,1000);

function updateCounter(){
    const minutes = Math.floor(timeOfExam/60);
    let seconds = timeOfExam % 60;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    if(minutes <= 5){
        displayCounter.innerHTML = `<span class="text-dark-red-gradient">${minutes}: ${seconds}</span>`;
    }else{
        displayCounter.innerHTML = `<span class="text-dark-green-gradient">${minutes}: ${seconds}</span>`;
    }
    timeOfExam--;
}

(function($){
    // Initiate the paginator on the .items-container element.
    var paginator = new $('.items-container').joldPaginator({
        'perPage': 6,
        'items': '.item',
        'paginator': '.pagination-container',
        'indicator': {
            'selector': '.pagination-indicator',
            'text': 'Showing item {start}-{end} of {total}',
        }
    });
    // Toggle items
    $('body').on('change', '.js-toggle-items', function(e) {
        e.preventDefault();
        var checked = this.checked;
        $('.items-container').find('.item')
            .removeClass('item-hidden')
            .addClass('item-visible');
        // Include historical reports (invalid)
        if ( checked == true ) {
            $('.items-container').find('.item-toggleable')
                .removeClass('item-hidden')
                .addClass('item-visible');
        }
        // Exclude historical reports (invalid)
        if ( checked == false ) {
            $('.items-container').find('.item-toggleable')
                .removeClass('item-visible')
                .addClass('item-hidden');
        }
        // Reset the paginator
        paginator.init();
    });
})(jQuery);