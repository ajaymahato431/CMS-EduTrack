<footer class="footer">
    <div class="container-fluid">
       <div class="footer-in">
          <p class="mb-0">&copy 2024 EduTrack . <a href="https://www.ajaymahato9988.com.np/" style="text-decoration: none; color:white; font-weight: bold;">Ajay Mahato</a> . All Rights Reserved.</p>
       </div>
    </div>
 </footer>
          
 
</div>

</div>




<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>




<script>
$(document).ready(function(){
// Toggle sidebar and content area
$(".xp-menubar").on('click',function(){
$("#sidebar").toggleClass('active');
$("#content").toggleClass('active');
highlightActiveMenuItem(); // Call function to highlight active menu item
});

// Toggle sidebar and overlay
$('.xp-menubar,.body-overlay').on('click',function(){
$("#sidebar,.body-overlay").toggleClass('show-nav');
});

// Function to highlight active menu item
function highlightActiveMenuItem() {
var currentUrl = window.location.pathname;
$('.list-unstyled .active').removeClass('active'); // Remove active class from previous menu item
$('.list-unstyled a').each(function() {
  var menuItemUrl = $(this).attr('href');
  if (currentUrl === menuItemUrl) {
    $(this).closest('li').addClass('active');
    $(this).closest('.collapse').addClass('show');
  }
});
}

// Call the function on page load
highlightActiveMenuItem();
});


// Select all checkbox
$('#selectAll').click(function () {
$('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});


$(document).ready(function() {
// Event listener for edit button
$('.edit').click(function() {
    // Get the user ID from the data-id attribute
    var userId = $(this).data('id');
    // Set the value of the hidden input field
    $('#userId').val(userId);
});
});

$(document).ready(function() {
// Event listener for edit button
$('.delete').click(function() {
    // Get the user ID from the data-id attribute
    var user = $(this).data('id');
    console.log('User ID:', user); // Log user ID for debugging

    // Set the value of the hidden input field
    $('#user').val(user);
});
});

</script>