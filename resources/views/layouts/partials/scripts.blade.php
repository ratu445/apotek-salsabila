<!-- Custom Scripts -->
<script>
    // Toggle sidebar
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    
    // Enable tooltips
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip()
    });
    
    // Auto-close alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>