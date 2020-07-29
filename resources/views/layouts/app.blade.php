<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        {{-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" /> --}}
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    </head>
    <body data-modal="{{ old('modal', '') }}">
        @include('partials.nav')

        @yield('content')

        @include('partials.footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>

        <script type="text/javascript">
            var fileForm = null;

            function removeX(btn) {
                let modal = $(btn.data('target'));

                modal.find('h2').text(btn.data('title'));
                modal.find('#removeText').text(btn.data('text'));
                modal.find('form').attr('action', btn.data('action'));
                modal.find('#removeItemName').text(btn.data('name'));

                if (!btn.data('toggle') == true) {
                    modal.modal();
                }
            }

            $('[data-target="#editWishlistModal"]').click(function () {
                let modal = $($(this).data('target'));
                let form = modal.find('form');

                form.attr('action', $(this).data('action'));
                form.find('#update-wishlist-title').val($(this).data('title'));
                form.find('#update-wishlist-description').val($(this).data('description'));
            });

            $('[data-target="#addItemWishlistModal"]').click(function () {
                let modal = $($(this).data('target'));
                let title = $(this).data('items') > 0 ? 'Add A Wish' : 'Step 2: Add A Wish';

                modal.find('form').attr('action', $(this).data('action'));
                modal.find('h2').text(title);
            });

            $('[data-target="#removeItemWishlistModal"]').click(function () {
                removeX($(this));
            });

            $('[data-target="#editItemWishlistModal"]').click(function () {
                let modal = $($(this).data('target'));
                let form = modal.find('form');

                form.attr('action', $(this).data('action'));
                form.find('#update-item-name').val($(this).data('name'));
                form.find('#update-item-description').val($(this).data('description'));
                form.find('#update-item-price').val($(this).data('price'));
                form.find('#update-item-url').val($(this).data('shop_url'));
                form.find('#update-item-img_url').val($(this).data('img_url'));
                form.find('[data-tmpd] div').css('background-image', 'url("' + $(this).data('img_url') + '")');
            });

            $('[data-target="#participantsListModal"]').click(function () {
                let modal = $($(this).data('target'));
                let tblHolder = modal.find('.render-space').first();
                let participantsList = $('#participantList').clone();
                participantsList.removeClass('d-none');

                tblHolder.html(participantsList);

                let form = $('#inviteWishlistModal').find('form');
                
                form.attr('action', $(this).data('action'));
            });

            $('#addEmail').click(function () {
                let fldHolder = $('.input-cont');
                let emailField = $('#masterField').clone();
                emailField.removeAttr('id');
                emailField.val('');

                fldHolder.append(emailField);
            });

            if ($('[data-new]').data('new') == '1') {
                $('[data-target="#addItemWishlistModal"]').click();
            }

            if ($('body').data('modal').length > 0) {
                $($('body').data('modal')).modal();
            }

            $('.modal').on('hidden.bs.modal', function (e) {
                $('.alert').removeClass('show');
                $('.alert').addClass('d-none');
            });

            $('img').click(function () {
                let modal = $('#viewImageModal');

                modal.find('h2').text($(this).attr('alt'));
                modal.find('[data-img]').css('background-image', 'url("' + $(this).attr('src') + '")');
                modal.modal();
            });

            $('.trigFileField').click(function () {
                fileForm = $(this).parents('form');
                let fileField = fileForm.find('[type="file"]');

                if (fileField.length) {
                    fileField.change(function () {
                        var files = this.files;
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            fileForm.find('[data-tmpd]').find('div').css('background-image', 'url("' + e.target.result + '")');
                            fileForm.find('[data-tmpd]').removeClass('d-none');
                        }

                        reader.readAsDataURL(files[0]);
                    });


                    fileField.click();
                }
            });

            $('.modal').on('show.bs.modal', function (e) {
                fileForm = $(this).find('form');
                let imgUrlField = fileForm.find('[name="img_url"]');
                let fileField = fileForm.find('[type="file"]');

                if (fileForm.find('[data-tmpd] span').length > 0) {
                    fileForm.find('[data-tmpd] span').click(function () {
                        imgUrlField.val('');
                        fileField.val('');
                        fileForm.find('[data-tmpd]').addClass('d-none');
                    });
                }
            });

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
        @yield('js')
    </body>
</html>
