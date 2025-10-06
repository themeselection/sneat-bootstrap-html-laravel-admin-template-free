@extends('layouts/contentNavbarLayout')

@section('title', 'OffCanvas - UI elements')

@section('content')
<div class="row gy-6">
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Placements</h5>
            <div class="card-body">
                <div class="row gy-3">
                    <!-- Default Offcanvas -->
                    <div class="col-lg-3 col-md-6">
                        <small class="fw-medium mb-4">Start (Default)</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart" aria-controls="offcanvasStart">Toggle Start</button>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasStartLabel" class="offcanvas-title">Offcanvas Start</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Offcanvas -->
                    <div class="col-lg-3 col-md-6">
                        <small class="fw-medium mb-4">End</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">Toggle End</button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Offcanvas -->
                    <div class="col-lg-3 col-md-6">
                        <small class="fw-medium mb-4">Top</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Toggle Top</button>
                            <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasTopLabel" class="offcanvas-title">Offcanvas Top</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary me-3">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Offcanvas -->
                    <div class="col-lg-3 col-md-6">
                        <small class="fw-medium mb-4">Bottom</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Toggle Bottom</button>
                            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasBottomLabel" class="offcanvas-title">Offcanvas Bottom</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary me-3">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Backdrop</h5>
            <div class="card-body">
                <div class="row gy-3">
                    <!-- Enable Body Scrolling Offcanvas -->
                    <div class="col-lg-4 col-md-6">
                        <small class="fw-medium mb-4">Enable Body Scrolling</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScroll" aria-controls="offcanvasScroll">Enable Body Scrolling</button>
                            <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScroll" aria-labelledby="offcanvasScrollLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasScrollLabel" class="offcanvas-title">Offcanvas Scroll</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enable backdrop (default) Offcanvas -->
                    <div class="col-lg-4 col-md-6">
                        <small class="fw-medium mb-4">Enable backdrop (default)</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">Enable backdrop</button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasBackdropLabel" class="offcanvas-title">Enable backdrop</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enable Scrolling & Backdrop Offcanvas -->
                    <div class="col-lg-4 col-md-6">
                        <small class="fw-medium mb-4">Enable Scrolling & Backdrop</small>
                        <div class="mt-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">Enable both scrolling & backdrop</button>
                            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasBothLabel" class="offcanvas-title">Enable both scrolling & backdrop</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                                    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5>Responsive offcanvas</h5>
                <div>
                    <button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">Toggle offcanvas-xl</button>
                    <div class="alert alert-info d-xl-block d-none mt-4">Resize your browser to <code>xl</code> breakpoint to show the responsive offcanvas toggle.</div>
                    <div class="offcanvas offcanvas-start offcanvas-xl" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">offcanvas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-xl-none my-auto mx-0 flex-grow-0">
                            <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                            <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Dark Offcanvas -->
                <h5>Dark offcanvas</h5>
                <div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDark" aria-controls="offcanvasDark">Toggle Dark offcanvas</button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDark" aria-labelledby="offcanvasDarkLabel" data-bs-theme="dark">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasDarkLabel">Offcanvas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                            <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
                            <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
                            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection