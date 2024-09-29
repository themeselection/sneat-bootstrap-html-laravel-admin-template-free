@extends('layouts/contentNavbarLayout')

@section('title', 'Typography - UI elements')

@section('content')
<div class="row g-6 mb-6">
  <!-- Headings -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Headings</h5>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Heading 1</small></td>
            <td class="py-4">
              <h1 class="mb-0">Bootstrap heading</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Heading 2</small></td>
            <td class="py-4">
              <h2 class="mb-0">Bootstrap heading</h2>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 3</small></td>
            <td class="py-4">
              <h3 class="mb-0">Bootstrap heading</h3>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 4</small></td>
            <td class="py-4">
              <h4 class="mb-0">Bootstrap heading</h4>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 5</small></td>
            <td class="py-4">
              <h5 class="mb-0">Bootstrap heading</h5>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 6</small></td>
            <td class="py-4">
              <h6 class="mb-0">Bootstrap heading</h6>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Customizing headings -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Customizing Headings <small class="text-muted ms-1">Default</small></h5>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Heading 1</small></td>
            <td class="py-4">
              <h1 class="mb-0">Bootstrap <small class="text-muted">heading</small></h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Heading 2</small></td>
            <td class="py-4">
              <h2 class="mb-0">Bootstrap <small class="text-muted">heading</small></h2>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 3</small></td>
            <td class="py-4">
              <h3 class="mb-0">Bootstrap <small class="text-muted">heading</small></h3>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 4</small></td>
            <td class="py-4">
              <h4 class="mb-0">Bootstrap <small class="text-muted">heading</small></h4>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 5</small></td>
            <td class="py-4">
              <h5 class="mb-0">Bootstrap <small class="text-muted">heading</small></h5>
            </td>
          </tr>
          <tr>
            <td><small class="text-light fw-medium">Heading 6</small></td>
            <td class="py-4">
              <h6 class="mb-0">Bootstrap <small class="text-muted">heading</small></h6>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row g-6 mb-6">
  <!-- Display headings -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Display headings</h5>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 1</small></td>
            <td class="py-4">
              <h1 class="display-1 mb-0">Display 1</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 2</small></td>
            <td class="py-4">
              <h1 class="display-2 mb-0">Display 2</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 3</small></td>
            <td class="py-4">
              <h1 class="display-3 mb-0">Display 3</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 4</small></td>
            <td class="py-4">
              <h1 class="display-4 mb-0">Display 4</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 5</small></td>
            <td class="py-4">
              <h1 class="display-5 mb-0">Display 5</h1>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Display 6</small></td>
            <td class="py-4">
              <h1 class="display-6 mb-0">Display 6</h1>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Paragraph -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Paragraph</h5>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Paragraph</small></td>
            <td class="py-4">
              <p class="mb-0">
                Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus.
                Duis mollis, est non commodo luctus.Duis mollis, est non commodo luctus.
              </p>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Lead Text</small></td>
            <td class="py-6">
              <p class="lead mb-0">
                Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus.Duis mollis, est non commodo luctus.
              </p>
            </td>
          </tr>
          <tr>
            <td class="align-middle"><small class="text-light fw-medium">Muted text</small></td>
            <td class="py-4">
              <p class="text-muted mb-0">
                Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo
                luctus.
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row g-6 mb-6">
  <!-- Inline text elements -->
  <div class="col">
    <div class="card">
      <h5 class="card-header">Inline Text Elements</h5>
      <div class="card-body">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td class="align-middle"><small class="text-light fw-medium">Text Highlight</small></td>
              <td class="py-4">
                <p class="mb-0">You can use the mark tag to <mark>highlight</mark> text.</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-medium">Deleted Text</small></td>
              <td class="py-4">
                <p class="mb-0"><del>This line of text is meant to be treated as deleted text.</del></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">No Longer Correct</small></td>
              <td class="py-4">
                <p class="mb-0"><s>This line of text is meant to be treated as no longer accurate.</s></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Addition</small></td>
              <td class="py-4">
                <p class="mb-0"><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Underlined</small></td>
              <td class="py-4">
                <p class="mb-0"><u>This line of text will render as underlined</u></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Fine Print</small></td>
              <td class="py-4">
                <p class="mb-0"><small>This line of text is meant to be treated as fine print.</small></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Bold Text</small></td>
              <td class="py-4">
                <p class="mb-0"><strong>This line rendered as bold text.</strong></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Italicized Text</small></td>
              <td class="py-4">
                <p class="mb-0"><em>This line rendered as italicized text.</em></p>
              </td>
            </tr>
            <tr>
              <td><small class="text-light fw-medium">Abbreviations</small></td>
              <td>
                <p><abbr title="attribute">attr</abbr></p>
                <p class="mb-0"><abbr title="HyperText Markup Language" class="initialism">HTML</abbr></p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row g-6">
  <!-- Blockquote -->
  <div class="col-lg">
    <div class="card mb-lg-0">
      <h5 class="card-header">Blockquote</h5>
      <div class="card-body">
        <blockquote class="blockquote mt-4">
          <p class="mb-0">A well-known quote, contained in a blockquote element.</p>
        </blockquote>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-medium">Naming a source</small>
        <figure class="mt-2">
          <blockquote class="blockquote">
            <p class="mb-0">A well-known quote, contained in a blockquote element.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
            Someone famous in <cite title="Source Title">Source Title</cite>
          </figcaption>
        </figure>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-medium">Align Center</small>
        <figure class="text-center mt-2">
          <blockquote class="blockquote">
            <p class="mb-0">A well-known quote, contained in a blockquote element.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
            Someone famous in <cite title="Source Title">Source Title</cite>
          </figcaption>
        </figure>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-medium">Align Right</small>
        <figure class="text-end mt-2">
          <blockquote class="blockquote">
            <p class="mb-0">A well-known quote, contained in a blockquote element.</p>
          </blockquote>
          <figcaption class="blockquote-footer">
            Someone famous in <cite title="Source Title">Source Title</cite>
          </figcaption>
        </figure>
      </div>

    </div>
  </div>
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Lists</h5>
      <div class="card-body">
        <small class="text-light fw-medium">Unstyled</small>
        <ul class="list-unstyled mt-2">
          <li>Lorem ipsum dolor sit amet</li>
          <li>Facilisis in pretium nisl aliquet</li>
          <li>
            Nulla volutpat aliquam velit
            <ul>
              <li>Phasellus iaculis neque</li>
              <li>Ac tristique libero volutpat at</li>
            </ul>
          </li>
          <li>Faucibus porta lacus fringilla vel</li>
        </ul>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-medium">Inline</small>
        <ul class="list-inline mt-2">
          <li class="list-inline-item">Lorem ipsum</li>
          <li class="list-inline-item">Phasellus iaculis</li>
          <li class="list-inline-item">Nulla volutpat</li>
        </ul>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-medium">Description list alignment</small>
        <dl class="row mt-2">
          <dt class="col-sm-3">Description lists</dt>
          <dd class="col-sm-9">A description list is perfect for defining terms.</dd>

          <dt class="col-sm-3">Euismod</dt>
          <dd class="col-sm-9">
            <p>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</p>
          </dd>

          <dt class="col-sm-3">Malesuada porta</dt>
          <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>

          <dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
          <dd class="col-sm-9">
            Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.
          </dd>

          <dt class="col-sm-3">Nesting</dt>
          <dd class="col-sm-9">
            <dl class="row">
              <dt class="col-sm-4">Nested definition list</dt>
              <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
            </dl>
          </dd>
        </dl>
      </div>
    </div>
  </div>
</div>
@endsection
