@extends('layouts/contentNavbarLayout')

@section('title', 'Cards basic   - UI elements')

@section('vendor-script')
@vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
<!-- Examples -->
<div class="row mb-12 g-6">
  <div class="col-md-6 col-lg-4">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle">Support card subtitle</h6>
      </div>
      <img class="img-fluid" src="{{asset('assets/img/elements/13.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
        <a href="javascript:void(0);" class="card-link">Card link</a>
        <a href="javascript:void(0);" class="card-link">Another link</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle">Support card subtitle</h6>
        <img class="img-fluid d-flex mx-auto my-6 rounded" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
        <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
        <a href="javascript:void(0);" class="card-link">Card link</a>
        <a href="javascript:void(0);" class="card-link">Another link</a>
      </div>
    </div>
  </div>
</div>
<!-- Examples -->

<!-- Content types -->
<h5 class="pb-1 mb-6">Content types</h5>

<div class="row mb-12 g-6">
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Body</h6>
    <div class="card mb-6">
      <div class="card-body">
        <p class="card-text">
          This is some text within a card body.
          Jelly lemon drops tiramisu chocolate cake cotton candy soufflé oat cake sweet roll. Sugar plum marzipan dragée
          topping cheesecake chocolate bar. Danish muffin icing donut.
        </p>
      </div>
    </div>
    <h6 class="mt-2 text-muted">Titles, text, and links</h6>
    <div class="card mb-6">
      <div class="card-body">
        <h5 class="card-title mb-1">Card title</h5>
        <div class="card-subtitle mb-4">Card subtitle</div>
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <a href="javascript:void(0)" class="card-link">Card link</a>
        <a href="javascript:void(0)" class="card-link">Another link</a>
      </div>
    </div>
    <h6 class="mt-2 text-muted">List groups</h6>
    <div class="card mb-6">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Images</h6>
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <p class="card-text">Cookie topping caramels jujubes gingerbread. Lollipop apple pie cupcake candy canes cookie
          ice cream. Wafer chocolate bar carrot cake jelly-o.</p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <h6 class="mt-2 text-muted">Kitchen sink</h6>
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/7.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title.
        </p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
      <div class="card-body">
        <a href="javascript:void(0)" class="card-link">Card link</a>
        <a href="javascript:void(0)" class="card-link">Another link</a>
      </div>
    </div>
  </div>
</div>

<h6 class="pb-1 mb-6 text-muted">Header and footer</h6>
<div class="row mb-12 g-6">
  <div class="col-md-6 col-lg-4">
    <div class="card">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">
          With supporting text below as a natural lead-in to additional content natural lead-in to additional content.
        </p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card">
      <h5 class="card-header">Quote</h5>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.Lorem ipsum dolor sit
            amet,
            consectetur.
          </p>
          <footer class="blockquote-footer">
            Someone famous in
            <cite title="Source Title">Source Title</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
      <div class="card-footer text-muted">
        2 days ago
      </div>
    </div>
  </div>
</div>
<!--/ Content types -->

<!-- Text alignment -->
<h5 class="pb-1 mb-6">Text alignment</h5>
<div class="row mb-12 g-6">
  <div class="col-md-6 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4">
    <div class="card text-end">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
<!--/ Text alignment -->

<!-- Images -->
<h5 class="pb-1 mb-6">Images caps & overlay</h5>
<div class="row mb-12 g-6">
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">
          <small class="text-muted">Last updated 3 mins ago</small>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">
          <small class="text-muted">Last updated 3 mins ago</small>
        </p>
      </div>
      <img class="card-img-bottom" src="{{asset('assets/img/elements/1.jpg')}}" alt="Card image cap" />
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-dark border-0 text-white">
      <img class="card-img" src="{{asset('assets/img/elements/11.jpg')}}" alt="Card image" />
      <div class="card-img-overlay">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
          little bit longer.
        </p>
        <p class="card-text">Last updated 3 mins ago</p>
      </div>
    </div>
  </div>
</div>
<!--/ Images -->

<!-- Horizontal -->
<h5 class="pb-1 mb-6">Horizontal</h5>
<div class="row mb-12 g-6">
  <div class="col-md">
    <div class="card">
      <div class="d-flex">
        <div>
          <img class="card-img card-img-left" src="{{asset('assets/img/elements/12.jpg')}}" alt="Card image" />
        </div>
        <div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This is a wider card with supporting text below as a natural lead-in to additional content. This content
              is a
              little bit longer.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md">
    <div class="card">
      <div class="d-flex">
        <div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              This is a wider card with supporting text below as a natural lead-in to additional content. This content
              is a
              little bit longer.
            </p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div>
          <img class="card-img card-img-right" src="{{asset('assets/img/elements/17.jpg')}}" alt="Card image" />
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Horizontal -->

<!-- Style variation -->
<h5 class="pb-1 mb-4">Style variation</h5>
<h6 class="pb-1 mb-4 text-muted">Default(solid)</h6>
<div class="row g-6 mb-6">
  <div class="col-md-6 col-xl-4">
    <div class="card bg-primary text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Primary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-secondary text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Secondary card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-success text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Success card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-danger text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Danger card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-warning text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Warning card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card bg-info text-white">
      <div class="card-body">
        <h5 class="card-title text-white">Info card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Outline -->
<h6 class="pb-1 mb-4 text-muted">Outline</h6>
<div class="row g-6">
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-primary">
      <div class="card-body">
        <h5 class="card-title text-primary">Primary card title</h5>
        <p class="card-text text-primary">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-secondary">
      <div class="card-body">
        <h5 class="card-title text-secondary">Secondary card title</h5>
        <p class="card-text text-secondary">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-success">
      <div class="card-body">
        <h5 class="card-title text-success">Success card title</h5>
        <p class="card-text text-success">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-danger">
      <div class="card-body">
        <h5 class="card-title text-danger">Danger card title</h5>
        <p class="card-text text-danger">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-warning">
      <div class="card-body">
        <h5 class="card-title text-warning">Warning card title</h5>
        <p class="card-text text-warning">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4">
    <div class="card shadow-none bg-transparent border border-info">
      <div class="card-body">
        <h5 class="card-title text-info">Info card title</h5>
        <p class="card-text text-info">
          Some quick example text to build on the card title and make up.
        </p>
      </div>
    </div>
  </div>
</div>
<!--/ Style variation -->


<!-- Card layout -->
<h5 class="pb-1 my-12">Card layout</h5>

<!-- Card Groups -->
<h6 class="pb-1 mb-6 text-muted">Card Groups</h6>
<div class="card-group mb-12">
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">
        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a
        little
        bit longer.
      </p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="{{asset('assets/img/elements/1.jpg')}}" alt="Card image cap" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">
        This is a wider card with supporting text below as a natural lead-in to additional content. This card has even
        longer
        content than the first to show that equal height action.
      </p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>

<!-- Grid Card -->
<h6 class="pb-1 mb-6 text-muted">Grid Card</h6>
<div class="row row-cols-1 row-cols-md-3 g-6 mb-12">
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/13.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/19.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/20.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>

<!-- Masonry -->
<h6 class="pb-1 mb-6 text-muted">Masonry</h6>
<div class="row g-6" data-masonry='{"percentPosition": true }'>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/5.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title that wraps to a new line</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card p-4">
      <figure class="p-4 mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
      <img class="card-img-top" src="{{asset('assets/img/elements/18.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card bg-primary text-white text-center p-4">
      <figure class="mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-white">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
      <img class="card-img" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card p-4 text-end">
      <figure class="mb-0">
        <blockquote class="blockquote">
          <p>A well-known quote, contained in a blockquote element.</p>
        </blockquote>
        <figcaption class="blockquote-footer mb-0 text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>
<!--/ Card layout -->
@endsection
