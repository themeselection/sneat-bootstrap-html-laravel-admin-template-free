@extends('layouts/contentNavbarLayout')

@section('title', 'Tabs and pills - UI elements')

@section('content')
<!-- Tabs -->
<h5 class="py-4 my-6">Tabs</h5>

<div class="row g-6">
    <div class="col-xl-6">
        <h6 class="text-body-secondary">Basic</h6>
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">Messages</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                    <p>Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear claw candy topping.</p>
                    <p class="mb-0">Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.</p>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <p>Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.</p>
                    <p class="mb-0">Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy liquorice caramels.</p>
                </div>
                <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                    <p>Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi bears cake chocolate.</p>
                    <p class="mb-0">Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie jelly.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <h6 class="text-body-secondary">Filled Tabs</h6>
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base bx bx-home icon-sm me-1_5"></i>Home
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1_5">3</span>
                        </span>
                        <i class="icon-base bx bx-home icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-user icon-sm me-1_5"></i>Profile</span>
                        <i class="icon-base bx bx-user icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-message-square icon-sm me-1_5"></i>Messages</span>
                        <i class="icon-base bx bx-message-square icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                    <p>Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear claw candy topping.</p>
                    <p class="mb-0">Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.</p>
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <p>Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.</p>
                    <p class="mb-0">Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy liquorice caramels.</p>
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                    <p>Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi bears cake chocolate.</p>
                    <p class="mb-0">Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie jelly.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tabs -->

<hr class="container-m-nx mt-12" />

<!-- Pills -->
<h5 class="py-4 my-6">Pills</h5>

<div class="row g-6">
    <div class="col-xl-6">
        <h6 class="text-body-secondary">Basic</h6>
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-4" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">Messages</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                    <p>Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear claw candy topping.</p>
                    <p class="mb-0">Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.</p>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                    <p>Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.</p>
                    <p class="mb-0">Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy liquorice caramels.</p>
                </div>
                <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                    <p>Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi bears cake chocolate.</p>
                    <p class="mb-0">Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie jelly.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <h6 class="text-body-secondary">Filled Pills</h6>
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                            <i class="icon-base bx bx-home icon-sm me-1_5"></i>Home
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1_5">3</span>
                        </span>
                        <i class="icon-base bx bx-home icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item mb-1 mb-sm-0">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-user icon-sm me-1_5"></i>Profile</span>
                        <i class="icon-base bx bx-user icon-sm d-sm-none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"><i class="icon-base bx bx-message-square icon-sm me-1_5"></i>Messages</span>
                        <i class="icon-base bx bx-message-square icon-sm d-sm-none"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    <p>Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear claw candy topping.</p>
                    <p class="mb-0">Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.</p>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    <p>Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.</p>
                    <p class="mb-0">Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy liquorice caramels.</p>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                    <p>Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi bears cake chocolate.</p>
                    <p class="mb-0">Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie jelly.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pills -->
@endsection