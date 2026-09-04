jQuery(function($) {
    // Add button to add more fields
    $(document).on('click', '#add-fasilitas', function(e) {
        e.preventDefault();
        $('#fasilitas-container').append('<div class="fasilitas-item"><input type="text" name="fasilitas[]" value="" placeholder="Masukkan fasilitas..." /> <button type="button" class="remove-fasilitas"><span class="dashicons dashicons-trash"></span></button></div>');
    });
    
    // Remove button to remove fields - menggunakan event delegation
    $(document).on('click', '.remove-fasilitas', function(e) {
        e.preventDefault();
        // Cek apakah masih ada lebih dari 1 item
        if ($('#fasilitas-container .fasilitas-item').length <= 1) {
            console.log('Minimal harus ada satu fasilitas!');
            return;
        }
        
        // Konfirmasi sebelum menghapus
        if (confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')) {
            $(this).closest('.fasilitas-item').remove();
        }
    });
});
