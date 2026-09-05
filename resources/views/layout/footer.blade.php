<footer class="footer">
    <div class="container-fluid">
        <div class="footer-in">
            <p class="mb-0">&copy; {{ now()->year }} EduTrack &bull; Educational Management System &bull; All Rights Reserved. &bull; Designed and Developed by <a href="https://ajaymahato9988.com.np" target="_blank" rel="noopener noreferrer" style="color: #49D292; font-weight: 500; text-decoration: none;">Ajay Mahato</a></p>
        </div>
    </div>
</footer>

<script>
    $(function () {
        function highlightActiveMenuItem() {
            var currentUrl = window.location.pathname;
            $('.list-unstyled .active').removeClass('active');
            $('.list-unstyled a').each(function () {
                var menuItemUrl = $(this).attr('href');
                if (currentUrl === menuItemUrl) {
                    $(this).closest('li').addClass('active');
                    $(this).closest('.collapse').addClass('show');
                }
            });
        }

        highlightActiveMenuItem();

        function initCheckboxGroup(wrapper) {
            var selectAll = wrapper.find('.select-all-checkbox');
            var rowCheckboxes = wrapper.find('.row-checkbox');

            if (!selectAll.length) {
                return;
            }

            selectAll.on('change', function () {
                var checked = $(this).prop('checked');
                rowCheckboxes.prop('checked', checked).trigger('change');
            });

            rowCheckboxes.on('change', function () {
                if (!$(this).prop('checked')) {
                    selectAll.prop('checked', false);
                    return;
                }

                var allChecked = rowCheckboxes.length === rowCheckboxes.filter(':checked').length;
                selectAll.prop('checked', allChecked);
            });
        }

        $('.table-wrapper').each(function () {
            initCheckboxGroup($(this));
        });

        function populateFields(modal, mapping) {
            Object.keys(mapping).forEach(function (selector) {
                var value = mapping[selector];
                var field = modal.find(selector);
                if (!field.length) {
                    return;
                }

                if (field.is('select')) {
                    field.val(value || '');
                } else {
                    field.val(value != null ? value : '');
                }
            });
        }

        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }

            var modal = $(this);
            populateFields(modal, {
                '#edit-user-id': button.data('id'),
                '#edit-user-name': button.data('name'),
                '#edit-user-email': button.data('email'),
                '#edit-user-role': button.data('role-id')
            });
            modal.find('#edit-user-password, #edit-user-password-confirmation').val('');
        });

        $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }
            var modal = $(this);
            modal.find('#delete-user-id').val(button.data('id'));
            var name = button.data('name');
            modal.find('#delete-user-message').text('Are you sure you want to delete ' + (name || 'this user') + '?');
        });

        $('#editCourseModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }
            var modal = $(this);
            populateFields(modal, {
                '#edit-course-id': button.data('id'),
                '#teacher-edit-course-id': button.data('id'),
                '#edit-course-name': button.data('name'),
                '#teacher-edit-course-name': button.data('name'),
                '#edit-course-credit-hours': button.data('credit-hours'),
                '#teacher-edit-course-credit-hours': button.data('credit-hours'),
                '#edit-course-fee': button.data('fee'),
                '#teacher-edit-course-fee': button.data('fee')
            });
        });

        $('#deleteCourseModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }
            var modal = $(this);
            var courseId = button.data('id');
            var courseName = button.data('name');
            modal.find('#delete-course-id, #teacher-delete-course-id').val(courseId);
            modal.find('#delete-course-message, #teacher-delete-course-message')
                .text('Are you sure you want to delete ' + (courseName || 'this course') + '?');
        });

        $('#editStudentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }
            var modal = $(this);
            populateFields(modal, {
                '#edit-student-id': button.data('id'),
                '#teacher-edit-student-id': button.data('id'),
                '#edit-student-name': button.data('name'),
                '#teacher-edit-student-name': button.data('name'),
                '#edit-student-sex': button.data('sex'),
                '#teacher-edit-student-sex': button.data('sex'),
                '#edit-student-phone': button.data('phone'),
                '#teacher-edit-student-phone': button.data('phone'),
                '#edit-student-address': button.data('address'),
                '#teacher-edit-student-address': button.data('address'),
                '#edit-student-course': button.data('course-id'),
                '#teacher-edit-student-course': button.data('course-id'),
                '#edit-student-fee': button.data('fee'),
                '#teacher-edit-student-fee': button.data('fee')
            });
        });

        $('#deleteStudentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            if (!button.length) {
                return;
            }
            var modal = $(this);
            var studentId = button.data('id');
            var studentName = button.data('name');
            modal.find('#delete-student-id, #teacher-delete-student-id').val(studentId);
            modal.find('#delete-student-message, #teacher-delete-student-message')
                .text('Are you sure you want to delete ' + (studentName || 'this student') + '?');
        });

        function bindBulkDelete(buttonSelector, checkboxSelector, modalSelector, inputsSelector, messageSelector) {
            $(document).on('click', buttonSelector, function (e) {
                e.preventDefault();
                var ids = $(checkboxSelector + ':checked').map(function () {
                    return $(this).val();
                }).get();

                if (!ids.length) {
                    alert('Please select at least one record.');
                    return;
                }

                var modal = $(modalSelector);
                var container = modal.find(inputsSelector).empty();
                ids.forEach(function (id) {
                    $('<input>', { type: 'hidden', name: 'selected_ids[]', value: id }).appendTo(container);
                });

                if (messageSelector) {
                    var message = 'You are about to delete ' + ids.length + ' ' + (ids.length === 1 ? 'record' : 'records') + '.';
                    modal.find(messageSelector).text(message);
                }

                modal.modal('show');
            });
        }

        bindBulkDelete('#bulkDeleteUsersButton', '.user-row-checkbox', '#bulkDeleteUsersModal',
            '#bulk-delete-users-inputs', '#bulk-delete-users-message');
        bindBulkDelete('#bulkDeleteCoursesButton', '.course-row-checkbox', '#bulkDeleteCoursesModal',
            '#bulk-delete-courses-inputs', '#bulk-delete-courses-message');
        bindBulkDelete('#bulkDeleteStudentsButton', '.student-row-checkbox', '#bulkDeleteStudentsModal',
            '#bulk-delete-students-inputs', '#bulk-delete-students-message');
        bindBulkDelete('#teacherBulkDeleteCoursesButton', '.teacher-course-row-checkbox', '#teacherBulkDeleteCoursesModal',
            '#teacher-bulk-delete-courses-inputs', '#teacher-bulk-delete-courses-message');
        bindBulkDelete('#teacherBulkDeleteStudentsButton', '.teacher-student-row-checkbox', '#teacherBulkDeleteStudentsModal',
            '#teacher-bulk-delete-students-inputs', '#teacher-bulk-delete-students-message');

        // Fast in-page live filter for tables
        var searchInput = $('.xp-searchbar input[type="search"]');
        var searchForm = $('.xp-searchbar form');

        function applySearchFilter() {
            var query = searchInput.val().toLowerCase();
            $('.table-wrapper:visible table tbody tr').each(function () {
                var row = $(this);
                if (!row.children('td').length || row.find('.empty-state').length) {
                    return;
                }
                var text = row.text().toLowerCase();
                var matches = query === '' || text.indexOf(query) !== -1;
                row.toggle(matches);
            });
        }

        searchInput.on('input', applySearchFilter);
        searchForm.on('submit', function (event) {
            event.preventDefault();
            applySearchFilter();
        });
    });
</script>

@if (session('show_modal'))
    <script>
        $(function () {
            var target = '#{{ session('show_modal') }}';
            if ($(target).length) {
                $(target).modal('show');
            }
        });
    </script>
@endif
