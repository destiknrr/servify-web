$(document).ready(function(){
    var currentStep = 1;

    function showStep(step) {
        $('.form-step').hide();
        $('#step-' + step).show();
    }

    $('.next-step').click(function(){
        var current_fs = $(this).closest('.form-step');
        var next_fs = current_fs.next();

        // Basic validation
        var inputs = current_fs.find('input[required], textarea[required]');
        var isValid = true;
        inputs.each(function(){
            if($(this).val() === ''){
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if(isValid){
            if(currentStep == 3){
                // Generate summary
                var summary = `
                    <h5>Jadwal Kunjungan</h5>
                    <p>Tanggal: ${$('#service-date').val()}</p>
                    <p>Waktu: ${$('input[name=visit_time]:checked').val()}</p>
                    <hr>
                    <h5>Detail Laptop</h5>
                    <p>Merk & Model: ${$('#laptop-brand').val()}</p>
                    <p>Kerusakan: ${$('#damage-description').val()}</p>
                    <hr>
                    <h5>Data Kontak</h5>
                    <p>Nama: ${$('#customer-name').val()}</p>
                    <p>No. HP: ${$('#customer-phone').val()}</p>
                    <p>Alamat: ${$('#customer-address').val()}</p>
                `;
                $('#summary').html(summary);
            }

            currentStep++;
            showStep(currentStep);
        }
    });

    $('.prev-step').click(function(){
        currentStep--;
        showStep(currentStep);
    });
});
