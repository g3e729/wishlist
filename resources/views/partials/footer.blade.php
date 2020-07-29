<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="font-size: 60px;">
                WishlistApp
            </div>
        </div>

        <div class="row d-none">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    2215 John Daniel Drive
                    <br />
                    Clark, MO 65243
                </p>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About Freelancer</h4>
                <p class="lead mb-0">
                    Freelance is a free to use, MIT licensed Bootstrap theme created by
                    <a href="http://startbootstrap.com">Start Bootstrap</a>
                    .
                </p>
            </div>
        </div>
    </div>
</footer>
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright © WishlistApp 2020</small></div>
</div>
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>

<!-- Modals -->

<div class="modal fade" id="createWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Step 1: Create Wishlist!'])
                            @include('partials.alert-danger')
                            
                            <form action="{{ route('wishlists.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="modal" value="#createWishlistModal">
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-title">Email Address</label>
                                        <input class="form-control" id="create-title" type="text" name="title" placeholder="Wishlist Title" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-description">Description</label>
                                        <textarea class="form-control" id="create-description" name="description" rows="5" placeholder="Write wishlist description"></textarea>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group"><button class="btn btn-primary" type="submit">Create</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Update Wishlist!'])
                            @include('partials.alert-danger')
                            
                            <form action="{{ $errors->count() ? session('lastAction') : '#' }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="modal" value="#editWishlistModal">
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-wishlist-title">Title</label>
                                        <input class="form-control" id="update-wishlist-title" type="text" name="title" placeholder="Wishlist Title" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-wishlist-description">Description</label>
                                        <textarea class="form-control" id="update-wishlist-description" name="description" rows="5" placeholder="Write wishlist description"></textarea>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group"><button class="btn btn-primary" type="submit">Update Wishlist!</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addItemWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Add A Wish!'])
                            @include('partials.alert-danger')
                            
                            <form action="{{ $errors->count() ? session('lastAction') : '#' }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="modal" value="#addItemWishlistModal">
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-item-name">Name</label>
                                        <input class="form-control" id="create-item-name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-item-description">Description</label>
                                        <textarea class="form-control" id="create-item-description" name="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-item-price">Price</label>
                                        <input class="form-control" id="create-item-price" type="text" name="price" value="{{ old('price') }}" placeholder="Price" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="create-item-url">URL</label>
                                        <input class="form-control" id="create-item-url" type="text" name="shop_url" value="{{ old('shop_url') }}" placeholder="Shop URL" />
                                    </div>
                                </div>

                                <div data-tmpd class="d-none" style="width: 50%; height: 300px; margin: 0 auto; margin-top: 30px;">
                                    <div style="width: 100%; height: 100%; background-color: black; background-position: center;background-size: cover; 
                                    "></div>
                                    <span class="btn rmv">< remove ></span>
                                </div>

                                <input type="hidden" name="img_url" value="{{ old('img_url') }}">
                                <input type="file" name="file" class="form-control d-none">
                                
                                <p class="mt-4"><span class="text-primary pointer trigFileField">Upload Photo</span> or <span class="getImages">get images from <span class="text-primary pointer">Imgur</span></span></p>

                                <div class="mt-5 d-none">
                                    <p class="text-left">Choose Image</p>
                                    <div class="row itemImageContainer" style="height: 300px; overflow-y: scroll;"></div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Make A Wish!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editItemWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Update Your Wish!'])
                            @include('partials.alert-danger')
                            
                            <form action="{{ $errors->count() ? session('lastAction') : '#' }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="modal" value="#editItemWishlistModal">
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-item-name">Name</label>
                                        <input class="form-control" id="update-item-name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-item-description">Description</label>
                                        <textarea class="form-control" id="update-item-description" name="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-item-price">Price</label>
                                        <input class="form-control" id="update-item-price" type="text" name="price" value="{{ old('price') }}" placeholder="Price" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                        <label class="text-left" for="update-item-url">URL</label>
                                        <input class="form-control" id="update-item-url" type="text" name="shop_url" value="{{ old('shop_url') }}" placeholder="Shop URL" />
                                    </div>
                                </div>

                                <div data-tmpd style="width: 50%; height: 300px; margin: 30px auto;">
                                    <div style="width: 100%; height: 100%; background-color: black; background-position: center;background-size: cover; background-image: url('');"></div>
                                    <span class="btn rmv">< remove ></span>
                                </div>

                                <input type="hidden" name="img_url" id="update-item-img_url" value="{{ old('img_url') }}">
                                <input type="file" name="file" class="form-control d-none">
                                
                                <p class="mt-4"><span class="text-primary pointer trigFileField">Upload Photo</span> or <span class="getImages">get images from <span class="text-primary pointer">Imgur</span></span></p>

                                <div class="mt-5 d-none">
                                    <p class="text-left">Choose Image</p>
                                    <div class="row itemImageContainer" style="height: 300px; overflow-y: scroll;"></div>
                                </div>

                                <br />
                                <div class="form-group">
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Update Wish!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="removeItemWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Remove Item'])
                            @include('partials.alert-danger')
                            
                            <form action="{{ $errors->count() ? session('lastAction') : '#' }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="modal" value="#removeItemWishlistModal">
                                <p><strong id="removeItemName"></strong></p>
                                <p id="removeText"></p>
                                <br />
                                <div class="form-group">
                                    <button class="btn btn-default" data-dismiss="modal">No</button>
                                    <button class="btn btn-danger" type="submit">Remove</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="participantsListModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Participants'])

                            <div class="render-space"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inviteWishlistModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @include('partials.header2', ['h2' => 'Invite'])
                            @include('partials.alert-danger')

                            <form action="{{ $errors->count() ? session('lastAction') : '#' }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="modal" value="#inviteWishlistModal">
                                <div class="input-cont">
                                    <div class="control-group" id="masterField">
                                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                            <label class="text-left" for="invite-email">Email</label>
                                            <input class="form-control" id="invite-email" type="email" name="emails[]" placeholder="Friend's Email" />
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <button type="button" id="addEmail" class="btn btn-default float-right">+add more</button>
                                <br />
                                <div class="form-group mt-3">
                                    <button class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#participantsListModal">Back</button>
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close text-right pt-2 pr-3" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="title text-secondary text-uppercase mb-0"></h2>
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>

                            <div style="width: 100%; height: 600px;">
                                <div data-img style="width: 100%; height: 100%; background-color: black; background-position: center;background-size: cover;
                                "></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
